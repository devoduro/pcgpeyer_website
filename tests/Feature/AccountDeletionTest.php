<?php

namespace Tests\Feature;

use App\Models\AppUser;
use App\Models\Devotional;
use App\Models\Member;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/** Google Play: users must be able to delete their account and data, in the app and on the web. */
class AccountDeletionTest extends TestCase
{
    private string $token;

    protected function setUp(): void
    {
        parent::setUp();
        $base = dirname(__DIR__, 2);
        Artisan::call('migrate:fresh', [
            '--realpath' => true,
            '--path' => [
                "$base/database/migrations/2024_01_01_000000_create_users_table.php",
                "$base/database/migrations/2026_10_17_000001_create_members_table.php",
                "$base/database/migrations/2026_10_17_000002_create_app_users_table.php",
                "$base/database/migrations/2026_10_18_000001_create_devotionals_tables.php",
                "$base/vendor/laravel/sanctum/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php",
            ],
        ]);
        $this->travelTo(Carbon::parse('2026-03-10 08:00:00', 'UTC'));

        $this->token = $this->register('ama@example.com', '0200111222');
    }

    private function register(string $email, string $phone): string
    {
        return $this->postJson('/api/v1/auth/register', [
            'name' => 'Ama Owusu', 'email' => $email, 'phone' => $phone,
            'password' => 'secret-pass-1', 'password_confirmation' => 'secret-pass-1',
        ])->assertCreated()->json('token');
    }

    /** Gives the account every kind of personal data the app stores. */
    private function fillWithData(): AppUser
    {
        $user = AppUser::first();
        $member = Member::create(['first_name' => 'Ama', 'last_name' => 'Owusu', 'member_number' => 'M-7']);
        $user->forceFill(['member_id' => $member->id])->save();

        $d = Devotional::create(['publish_date' => '2026-03-10', 'title' => 'T', 'scripture_reference' => 'Ps 23',
            'reflection' => 'r', 'question' => 'Q?', 'published' => true]);
        $this->withToken($this->token)->getJson("/api/v1/devotionals/{$d->id}")->assertOk();
        $this->travel(31)->seconds();
        $this->withToken($this->token)->postJson("/api/v1/devotionals/{$d->id}/complete", ['answer' => 'private thoughts'])->assertCreated();

        // A pending application for a second, unlinked user path is covered by the cascade; create one directly.
        DB::table('membership_applications')->insert(['app_user_id' => $user->id, 'status' => 'pending', 'congregation' => 'Peyer',
            'created_at' => now(), 'updated_at' => now()]);

        $this->assertSame(1, DB::table('devotional_completions')->count());
        $this->assertSame(1, DB::table('devotional_reads')->count());
        $this->assertSame(1, DB::table('app_auth_codes')->count()); // verification code from sign-up

        return $user;
    }

    private function assertAllPersonalDataGone(): void
    {
        $this->assertSame(0, AppUser::count());
        foreach (['personal_access_tokens', 'app_auth_codes', 'devotional_reads', 'devotional_completions', 'membership_applications'] as $table) {
            $this->assertSame(0, DB::table($table)->count(), "$table still has rows");
        }
        // The church's own register entry stays (it is not app data).
        $this->assertSame('M-7', Member::first()->member_number);
    }

    public function test_in_app_deletion_removes_all_personal_data(): void
    {
        $this->fillWithData();

        $this->withToken($this->token)->postJson('/api/v1/me/delete', ['password' => 'secret-pass-1'])
            ->assertOk()->assertJsonPath('message', 'Your account and its data have been permanently deleted.');

        $this->assertAllPersonalDataGone();
    }

    public function test_deleted_account_token_no_longer_works_and_email_can_register_again(): void
    {
        $this->withToken($this->token)->postJson('/api/v1/me/delete', ['password' => 'secret-pass-1'])->assertOk();
        $this->app['auth']->forgetGuards();

        $this->withToken($this->token)->getJson('/api/v1/me')->assertUnauthorized();
        $this->postJson('/api/v1/auth/login', ['email' => 'ama@example.com', 'password' => 'secret-pass-1'])->assertStatus(422);
        $this->register('ama@example.com', '0200111222'); // same email and phone are free again
    }

    public function test_in_app_deletion_requires_the_correct_password(): void
    {
        $this->withToken($this->token)->postJson('/api/v1/me/delete', ['password' => 'nope'])->assertStatus(422);
        $this->withToken($this->token)->postJson('/api/v1/me/delete', [])->assertStatus(422);
        $this->assertSame(1, AppUser::count());
    }

    public function test_web_page_deletes_the_account_without_the_app(): void
    {
        $this->fillWithData();

        $this->get('/account/delete')->assertOk()->assertSee('Delete your app account')->assertSee('What is deleted');

        $this->post('/account/delete', ['email' => 'AMA@example.com', 'password' => 'secret-pass-1', 'confirm' => '1'])
            ->assertRedirect('/account/delete')->assertSessionHas('deleted');

        $this->assertAllPersonalDataGone();
    }

    public function test_web_page_needs_correct_details_and_confirmation_without_revealing_accounts(): void
    {
        $wrong = $this->post('/account/delete', ['email' => 'ama@example.com', 'password' => 'wrong', 'confirm' => '1']);
        $unknown = $this->post('/account/delete', ['email' => 'ghost@example.com', 'password' => 'wrong', 'confirm' => '1']);
        $wrong->assertSessionHasErrors('email');
        $unknown->assertSessionHasErrors('email');
        $this->assertSame(session('errors')->first('email'), 'The email or password is not correct.');

        $this->post('/account/delete', ['email' => 'ama@example.com', 'password' => 'secret-pass-1'])
            ->assertSessionHasErrors('confirm');

        $this->assertSame(1, AppUser::count());
    }

    public function test_privacy_policy_and_terms_are_public_and_explain_deletion(): void
    {
        $this->get('/privacy-policy')->assertOk()
            ->assertSee('Privacy Policy')->assertSee('Delete account')->assertSee(route('legal.delete-account'))
            ->assertSee('Firebase')->assertSee('info@pcgpeyer.org');
        $this->get('/terms')->assertOk()->assertSee('Terms of Use')->assertSee(route('legal.delete-account'));
    }
}
