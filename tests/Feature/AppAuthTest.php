<?php

namespace Tests\Feature;

use App\Models\AppUser;
use App\Models\Member;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AppAuthTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // The legacy site migrations are MySQL-specific, so build only the tables the app API needs.
        $base = dirname(__DIR__, 2);
        Artisan::call("migrate:fresh", [
            "--realpath" => true,
            "--path" => [
                "$base/database/migrations/2024_01_01_000000_create_users_table.php",
                "$base/database/migrations/2026_10_17_000001_create_members_table.php",
                "$base/database/migrations/2026_10_17_000002_create_app_users_table.php",
                "$base/vendor/laravel/sanctum/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php",
            ],
        ]);
    }

    private function payload(array $over = []): array
    {
        return array_merge([
            'name' => 'Kofi Mensah',
            'email' => 'kofi@example.com',
            'phone' => '0244123456',
            'password' => 'secret-pass-1',
            'password_confirmation' => 'secret-pass-1',
        ], $over);
    }

    public function test_anyone_can_register_without_a_member_record(): void
    {
        $this->assertSame(0, Member::count());

        $res = $this->postJson('/api/v1/auth/register', $this->payload());

        $res->assertCreated()->assertJsonPath('user.membership_status', 'none')
            ->assertJsonPath('user.phone', '+233244123456')
            ->assertJsonPath('user.role', 'user');
        $this->assertNotEmpty($res->json('token'));
        $this->assertSame(0, Member::count());
    }

    public function test_duplicate_email_or_phone_is_rejected(): void
    {
        $this->postJson('/api/v1/auth/register', $this->payload())->assertCreated();

        $this->postJson('/api/v1/auth/register', $this->payload(['phone' => '0200000000']))
            ->assertStatus(422)->assertJsonValidationErrors('email');
        // same phone written differently
        $this->postJson('/api/v1/auth/register', $this->payload(['email' => 'b@example.com', 'phone' => '+233 24 412 3456']))
            ->assertStatus(422)->assertJsonValidationErrors('phone');
    }

    public function test_login_failure_is_identical_for_unknown_email_and_wrong_password(): void
    {
        $this->postJson('/api/v1/auth/register', $this->payload())->assertCreated();

        $a = $this->postJson('/api/v1/auth/login', ['email' => 'kofi@example.com', 'password' => 'nope-nope-1']);
        $b = $this->postJson('/api/v1/auth/login', ['email' => 'ghost@example.com', 'password' => 'nope-nope-1']);

        $a->assertStatus(422);
        $this->assertSame($a->json('errors'), $b->json('errors'));
    }

    public function test_login_me_and_logout(): void
    {
        $this->postJson('/api/v1/auth/register', $this->payload())->assertCreated();

        $token = $this->postJson('/api/v1/auth/login', ['email' => 'KOFI@example.com', 'password' => 'secret-pass-1'])
            ->assertOk()->json('token');

        $this->withToken($token)->getJson('/api/v1/me')->assertOk()->assertJsonPath('user.email', 'kofi@example.com');
        $this->withToken($token)->postJson('/api/v1/auth/logout')->assertOk();
        $this->assertSame(0, DB::table('personal_access_tokens')->count() - 1); // register token remains
    }

    public function test_protected_routes_require_a_token(): void
    {
        $this->getJson('/api/v1/me')->assertUnauthorized();
        $this->postJson('/api/v1/membership/apply', [])->assertUnauthorized();
    }

    public function test_suspended_user_is_blocked(): void
    {
        $token = $this->postJson('/api/v1/auth/register', $this->payload())->json('token');
        AppUser::first()->forceFill(['status' => 'suspended'])->save();

        $this->withToken($token)->getJson('/api/v1/me')->assertForbidden();
        $this->postJson('/api/v1/auth/login', ['email' => 'kofi@example.com', 'password' => 'secret-pass-1'])->assertForbidden();
    }

    public function test_email_verification_with_code(): void
    {
        $token = $this->postJson('/api/v1/auth/register', $this->payload())->json('token');

        $this->withToken($token)->postJson('/api/v1/auth/verify-email', ['code' => '000000'])->assertStatus(422);

        DB::table('app_auth_codes')->update(['code_hash' => bcrypt('123456')]);
        $this->withToken($token)->postJson('/api/v1/auth/verify-email', ['code' => '123456'])
            ->assertOk()->assertJsonPath('user.email_verified', true);
    }

    public function test_password_reset_flow_and_no_enumeration(): void
    {
        $this->postJson('/api/v1/auth/register', $this->payload())->assertCreated();

        $known = $this->postJson('/api/v1/auth/forgot-password', ['email' => 'kofi@example.com']);
        $unknown = $this->postJson('/api/v1/auth/forgot-password', ['email' => 'ghost@example.com']);
        $this->assertSame($known->json(), $unknown->json());

        DB::table('app_auth_codes')->where('type', 'reset_password')->update(['code_hash' => bcrypt('654321')]);
        $this->postJson('/api/v1/auth/reset-password', [
            'email' => 'kofi@example.com', 'code' => '654321',
            'password' => 'brand-new-pass', 'password_confirmation' => 'brand-new-pass',
        ])->assertOk();

        $this->postJson('/api/v1/auth/login', ['email' => 'kofi@example.com', 'password' => 'brand-new-pass'])->assertOk();
        $this->assertSame(0, DB::table('personal_access_tokens')->where('name', 'mobile')->count() - 1);
    }

    public function test_membership_application_does_not_create_or_link_members(): void
    {
        $existing = Member::create(['first_name' => 'Kofi', 'last_name' => 'Mensah', 'phone' => '+233244123456', 'member_number' => 'M-1']);
        $token = $this->postJson('/api/v1/auth/register', $this->payload())->json('token');

        $this->withToken($token)->postJson('/api/v1/membership/apply', ['congregation' => 'Peyer'])->assertCreated();
        $this->withToken($token)->postJson('/api/v1/membership/apply', ['congregation' => 'Peyer'])->assertStatus(409);

        $this->withToken($token)->getJson('/api/v1/membership/status')
            ->assertOk()->assertJsonPath('membership_status', 'applicant')->assertJsonPath('member_number', null);

        $this->assertSame(1, Member::count());
        $this->assertNull(AppUser::first()->member_id);
        $this->assertSame('M-1', $existing->fresh()->member_number);
    }

    public function test_account_deletion_request_deactivates_and_revokes_tokens(): void
    {
        $token = $this->postJson('/api/v1/auth/register', $this->payload())->json('token');

        $this->withToken($token)->postJson('/api/v1/me/delete', ['password' => 'wrong'])->assertStatus(422);
        $this->withToken($token)->postJson('/api/v1/me/delete', ['password' => 'secret-pass-1'])->assertOk();

        $this->assertSame('deactivated', AppUser::first()->status);
        $this->assertSame(0, DB::table('personal_access_tokens')->count());
    }
}
