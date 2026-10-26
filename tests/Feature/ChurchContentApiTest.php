<?php

namespace Tests\Feature;

use App\Models\Announcement;
use App\Models\Devotional;
use App\Models\Event;
use App\Models\Sermon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ChurchContentApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $base = dirname(__DIR__, 2);
        Artisan::call('migrate:fresh', [
            '--realpath' => true,
            '--path' => [
                "$base/database/migrations/2024_01_01_000004_create_events_table.php",
                "$base/database/migrations/2024_01_01_000005_create_sermons_table.php",
                "$base/database/migrations/2026_07_13_000000_create_announcements_table.php",
                "$base/database/migrations/2026_10_17_000001_create_members_table.php",
                "$base/database/migrations/2026_10_17_000002_create_app_users_table.php",
                "$base/database/migrations/2026_10_18_000001_create_devotionals_tables.php",
                "$base/database/migrations/2026_10_26_000001_add_notification_fields_to_devotionals.php",
                "$base/vendor/laravel/sanctum/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php",
            ],
        ]);
        $this->travelTo(Carbon::parse('2026-03-10 08:00:00', 'UTC'));
        config(['devotion.timezone' => 'Africa/Accra', 'devotion.policy' => 'required']);
    }

    private function event(string $title, string $start, array $over = []): Event
    {
        return Event::create($over + ['title' => $title, 'description' => 'Details', 'location' => 'Church hall',
            'start_date' => $start, 'category' => 'Services', 'published' => true]);
    }

    public function test_events_split_into_upcoming_soonest_first_and_past_newest_first(): void
    {
        $this->event('Harvest', '2026-04-20 09:00:00', ['image' => 'events/harvest.jpg']);
        $this->event('Easter', '2026-04-05 06:00:00');
        $this->event('Later today', '2026-03-10 18:00:00');
        $this->event('Christmas', '2025-12-25 09:00:00');
        $this->event('Draft', '2026-05-01 09:00:00', ['published' => false]);

        $up = $this->getJson('/api/v1/events')->assertOk();
        $this->assertSame(['Later today', 'Easter', 'Harvest'], array_column($up->json('events'), 'title'));
        $up->assertJsonPath('events.2.image_url', asset('storage/events/harvest.jpg'))
            ->assertJsonPath('events.0.starts_at', '2026-03-10T18:00:00+00:00');

        $this->getJson('/api/v1/events?when=past')->assertJsonPath('events.0.title', 'Christmas')->assertJsonCount(1, 'events');
    }

    public function test_sermons_newest_first_with_series_filter(): void
    {
        Sermon::create(['title' => 'Faith', 'preacher' => 'Rev. A', 'sermon_date' => '2026-03-01', 'series' => 'Faith Series',
            'audio_url' => 'https://example.org/faith.mp3', 'thumbnail' => 'sermons/faith.jpg']);
        Sermon::create(['title' => 'Prayer', 'preacher' => 'Rev. B', 'sermon_date' => '2026-03-08', 'series' => 'Prayer Life',
            'video_url' => 'https://youtu.be/abcdefghijk']);

        $this->getJson('/api/v1/sermons')->assertOk()
            ->assertJsonPath('sermons.0.title', 'Prayer')
            ->assertJsonPath('sermons.1.audio_url', 'https://example.org/faith.mp3')
            ->assertJsonPath('sermons.1.thumbnail_url', asset('storage/sermons/faith.jpg'))
            ->assertJsonPath('categories', ['Faith Series', 'Prayer Life']);

        $this->getJson('/api/v1/sermons?category=Faith%20Series')->assertJsonCount(1, 'sermons')->assertJsonPath('sermons.0.title', 'Faith');
    }

    public function test_announcements_only_live_ones_pinned_first(): void
    {
        Announcement::create(['title' => 'Old', 'message' => 'x', 'expires_at' => '2026-03-01']);
        Announcement::create(['title' => 'Soon', 'message' => 'x', 'starts_at' => '2026-03-20']);
        Announcement::create(['title' => 'Draft', 'message' => 'x', 'published' => false]);
        Announcement::create(['title' => 'Normal', 'message' => 'Choir practice moved.']);
        Announcement::create(['title' => 'Pinned', 'message' => 'Harvest on Sunday', 'pinned' => true, 'link_url' => 'https://example.org']);

        $res = $this->getJson('/api/v1/announcements')->assertOk();
        $this->assertSame(['Pinned', 'Normal'], array_column($res->json('announcements'), 'title'));
        $res->assertJsonPath('announcements.0.link_url', 'https://example.org');
    }

    public function test_events_and_sermons_follow_the_devotion_lock_announcements_do_not(): void
    {
        Devotional::create(['publish_date' => '2026-03-10', 'title' => 'Today', 'scripture_reference' => 'John 3:16',
            'reflection' => '<p>Reflect.</p>', 'published' => true]);
        $token = $this->postJson('/api/v1/auth/register', [
            'name' => 'Ama Owusu', 'email' => 'ama@example.com', 'phone' => '0200111222',
            'password' => 'secret-pass-1', 'password_confirmation' => 'secret-pass-1',
        ])->json('token');

        $this->withToken($token)->getJson('/api/v1/events')->assertStatus(423);
        $this->withToken($token)->getJson('/api/v1/sermons')->assertStatus(423);
        $this->withToken($token)->getJson('/api/v1/announcements')->assertOk();
    }
}
