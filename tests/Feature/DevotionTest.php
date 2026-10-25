<?php

namespace Tests\Feature;

use App\Models\Devotional;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class DevotionTest extends TestCase
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

        // Fixed clock so "today" is deterministic.
        $this->travelTo(Carbon::parse('2026-03-10 08:00:00', 'UTC'));
        config(['devotion.timezone' => 'Africa/Accra', 'devotion.policy' => 'required',
            'devotion.min_read_seconds' => 30, 'devotion.require_reflection' => false]);

        Route::middleware(['api', 'auth:sanctum', 'app.active', 'devotion.done'])
            ->get('/api/v1/_test/gated', fn () => response()->json(['ok' => true]));

        $this->token = $this->postJson('/api/v1/auth/register', [
            'name' => 'Ama Owusu', 'email' => 'ama@example.com', 'phone' => '0200111222',
            'password' => 'secret-pass-1', 'password_confirmation' => 'secret-pass-1',
        ])->json('token');
    }

    private function devotional(string $date = '2026-03-10', array $over = []): Devotional
    {
        return Devotional::create($over + [
            'publish_date' => $date, 'title' => "Devotion $date", 'scripture_reference' => 'John 3:16',
            'reflection' => '<p>Reflect.</p>', 'published' => true,
        ]);
    }

    private function complete(Devotional $d, array $body = [])
    {
        return $this->withToken($this->token)->postJson("/api/v1/devotionals/{$d->id}/complete", $body);
    }

    private function open(Devotional $d)
    {
        return $this->withToken($this->token)->getJson("/api/v1/devotionals/{$d->id}");
    }

    public function test_no_lock_when_no_devotional_is_published_today(): void
    {
        $this->devotional('2026-03-10', ['published' => false]);

        $this->withToken($this->token)->getJson('/api/v1/devotionals/status')
            ->assertOk()->assertJsonPath('has_devotional_today', false)->assertJsonPath('locked', false);
        $this->withToken($this->token)->getJson('/api/v1/_test/gated')->assertOk();
    }

    public function test_server_blocks_gated_content_until_completed(): void
    {
        $d = $this->devotional();

        $this->withToken($this->token)->getJson('/api/v1/_test/gated')
            ->assertStatus(423)->assertJsonPath('code', 'devotion_required');
        // Devotion and status routes stay reachable while locked.
        $this->withToken($this->token)->getJson('/api/v1/devotionals/today')->assertOk();

        $this->travel(31)->seconds();
        $this->complete($d)->assertCreated();

        $this->withToken($this->token)->getJson('/api/v1/_test/gated')->assertOk();
        $this->withToken($this->token)->getJson('/api/v1/devotionals/status')
            ->assertJsonPath('completed_today', true)->assertJsonPath('locked', false);
    }

    public function test_cannot_complete_without_opening_or_before_minimum_read_time(): void
    {
        $d = $this->devotional();

        $this->complete($d)->assertStatus(422); // never opened

        $this->open($d)->assertOk();
        $this->travel(10)->seconds();
        $this->complete($d)->assertStatus(422)->assertJsonPath('retry_after_seconds', 20);

        $this->travel(21)->seconds();
        $this->complete($d)->assertCreated();
    }

    public function test_completion_is_idempotent(): void
    {
        $d = $this->devotional();
        $this->open($d);
        $this->travel(31)->seconds();

        $this->complete($d)->assertCreated();
        $this->complete($d)->assertOk()->assertJsonPath('completed', true);
        $this->assertSame(1, \App\Models\DevotionalCompletion::count());
    }

    public function test_only_todays_published_devotional_can_be_completed_and_drafts_are_hidden(): void
    {
        $yesterday = $this->devotional('2026-03-09');
        $future = $this->devotional('2026-03-12');
        $draft = $this->devotional('2026-03-11', ['published' => false]);

        $this->open($yesterday)->assertOk();
        $this->complete($yesterday)->assertStatus(422);
        $this->open($future)->assertNotFound();
        $this->open($draft)->assertNotFound();
    }

    public function test_daily_reset_uses_the_church_timezone(): void
    {
        config(['devotion.timezone' => 'Pacific/Auckland']);
        $this->travelTo(Carbon::parse('2026-03-10 12:00:00', 'UTC')); // 01:00 on 11 Mar in Auckland (UTC+13)
        $mar10 = $this->devotional('2026-03-10');
        $mar11 = $this->devotional('2026-03-11');

        $this->withToken($this->token)->getJson('/api/v1/devotionals/today')
            ->assertOk()->assertJsonPath('devotional.id', $mar11->id);
        $this->assertNotSame($mar10->id, $mar11->id);
    }

    public function test_lock_returns_the_next_day(): void
    {
        $d1 = $this->devotional('2026-03-10');
        $d2 = $this->devotional('2026-03-11');

        $this->open($d1);
        $this->travel(31)->seconds();
        $this->complete($d1)->assertCreated();
        $this->withToken($this->token)->getJson('/api/v1/_test/gated')->assertOk();

        $this->travelTo(Carbon::parse('2026-03-11 06:00:00', 'UTC'));
        $this->withToken($this->token)->getJson('/api/v1/_test/gated')->assertStatus(423);
        $this->assertNotNull($d2);
    }

    public function test_streak_counts_consecutive_days_and_resets_after_a_gap(): void
    {
        foreach (['2026-03-08', '2026-03-09', '2026-03-10'] as $date) {
            $d = $this->devotional($date);
            $this->travelTo(Carbon::parse("$date 08:00:00", 'UTC'));
            $this->open($d);
            $this->travel(31)->seconds();
            $this->complete($d)->assertCreated();
        }
        $this->withToken($this->token)->getJson('/api/v1/devotionals/status')->assertJsonPath('streak', 3);

        // Skip 11 Mar entirely: on 12 Mar the streak is broken.
        $this->travelTo(Carbon::parse('2026-03-12 08:00:00', 'UTC'));
        $this->withToken($this->token)->getJson('/api/v1/devotionals/status')->assertJsonPath('streak', 0);

        $this->withToken($this->token)->getJson('/api/v1/devotionals/history?month=2026-03')
            ->assertOk()->assertJsonPath('completed_days', ['2026-03-08', '2026-03-09', '2026-03-10']);
    }

    public function test_reflection_answer_required_when_configured(): void
    {
        config(['devotion.require_reflection' => true]);
        $d = $this->devotional('2026-03-10', ['question' => 'What stood out?']);
        $this->open($d);
        $this->travel(31)->seconds();

        $this->complete($d)->assertStatus(422)->assertJsonValidationErrors('answer');
        $this->complete($d, ['answer' => 'God loves the world'])->assertCreated();
    }

    public function test_optional_policy_lets_users_choose_and_required_policy_does_not(): void
    {
        $this->devotional();

        config(['devotion.policy' => 'optional']);
        $this->withToken($this->token)->getJson('/api/v1/_test/gated')->assertOk();

        $this->withToken($this->token)->postJson('/api/v1/me/devotion-first', ['enabled' => true])
            ->assertOk()->assertJsonPath('locked', true);
        $this->withToken($this->token)->getJson('/api/v1/_test/gated')->assertStatus(423);

        config(['devotion.policy' => 'required']);
        $this->withToken($this->token)->postJson('/api/v1/me/devotion-first', ['enabled' => false])->assertStatus(409);
    }

    public function test_devotion_routes_require_authentication(): void
    {
        $this->getJson('/api/v1/devotionals/today')->assertUnauthorized();
        $this->getJson('/api/v1/devotionals/status')->assertUnauthorized();
    }
}
