<?php

namespace Tests\Feature;

use App\Models\Devotional;
use App\Models\Hymn;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/** The app can be used without an account: read devotions, hymns (and offline sync) as a guest. */
class GuestAccessTest extends TestCase
{
    private Devotional $devotional;

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
                "$base/database/migrations/2026_10_19_000001_create_hymns_tables.php",
                "$base/vendor/laravel/sanctum/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php",
            ],
        ]);
        $this->travelTo(Carbon::parse('2026-03-10 08:00:00', 'UTC'));
        config(['devotion.policy' => 'required', 'hymns.offline_sync_enabled' => true]);

        $this->devotional = Devotional::create(['publish_date' => '2026-03-10', 'title' => 'Walk in the light',
            'scripture_reference' => '1 John 1:7', 'reflection' => '<p>r</p>', 'published' => true]);
        $hymn = Hymn::create(['number' => 10, 'source_file' => 'HYMN 10.ppt', 'status' => 'published']);
        $hymn->verses()->create(['language' => 'tw', 'position' => 1, 'label' => 'Verse 1', 'text' => 'Sunsum, sɔre', 'review_status' => 'approved']);
    }

    public function test_guest_can_read_todays_devotion_without_any_record_being_made(): void
    {
        $this->getJson('/api/v1/devotionals/status')->assertOk()
            ->assertJsonPath('guest', true)->assertJsonPath('locked', false)
            ->assertJsonPath('has_devotional_today', true)->assertJsonPath('streak', 0);

        $this->getJson('/api/v1/devotionals/today')->assertOk()
            ->assertJsonPath('devotional.title', 'Walk in the light')->assertJsonPath('guest', true)
            ->assertJsonPath('completed', false);
        $this->getJson("/api/v1/devotionals/{$this->devotional->id}")->assertOk();

        $this->assertSame(0, DB::table('devotional_reads')->count());
    }

    public function test_guest_can_read_and_download_hymns_even_when_the_church_requires_devotion_first(): void
    {
        $this->getJson('/api/v1/hymns?language=tw')->assertOk()->assertJsonPath('data.0.number', 10);
        $this->getJson('/api/v1/hymns/10?language=tw')->assertOk()->assertJsonPath('hymn.verses.0.text', 'Sunsum, sɔre');
        $this->getJson('/api/v1/hymns/sync')->assertOk()->assertJsonPath('hymns.0.number', 10);
    }

    public function test_actions_that_save_personal_data_still_need_an_account(): void
    {
        $this->postJson("/api/v1/devotionals/{$this->devotional->id}/complete")->assertUnauthorized();
        $this->getJson('/api/v1/devotionals/history')->assertUnauthorized();
        $this->postJson('/api/v1/me/devotion-first', ['enabled' => true])->assertUnauthorized();
        $this->getJson('/api/v1/me')->assertUnauthorized();
        $this->postJson('/api/v1/membership/apply', ['congregation' => 'X'])->assertUnauthorized();
    }

    public function test_signed_in_users_on_the_same_public_routes_keep_their_lock_and_records(): void
    {
        $token = $this->postJson('/api/v1/auth/register', [
            'name' => 'Ama', 'email' => 'ama@example.com', 'phone' => '0200111222',
            'password' => 'secret-pass-1', 'password_confirmation' => 'secret-pass-1',
        ])->json('token');

        $this->withToken($token)->getJson('/api/v1/devotionals/status')
            ->assertJsonPath('guest', false)->assertJsonPath('locked', true);
        $this->withToken($token)->getJson('/api/v1/hymns?language=tw')->assertStatus(423);
        $this->withToken($token)->getJson('/api/v1/devotionals/today')->assertOk()->assertJsonPath('guest', false);
        $this->assertSame(1, DB::table('devotional_reads')->count());
    }

    public function test_an_expired_or_bad_token_on_a_public_route_is_treated_as_a_guest(): void
    {
        $this->withToken('not-a-real-token')->getJson('/api/v1/devotionals/status')
            ->assertOk()->assertJsonPath('guest', true);
    }
}
