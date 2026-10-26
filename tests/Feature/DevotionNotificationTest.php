<?php

namespace Tests\Feature;

use App\Models\Devotional;
use App\Models\User;
use App\Support\FcmPushNotifier;
use App\Support\PushNotifier;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Tests\TestCase;

/** Records pushes instead of sending them. */
class FakePush implements PushNotifier
{
    public array $sent = [];
    public bool $configured = true;
    public bool $fail = false;

    public function isConfigured(): bool
    {
        return $this->configured;
    }

    public function sendToTopic(string $topic, string $title, string $body, array $data = [], ?string $imageUrl = null): void
    {
        if ($this->fail) {
            throw new RuntimeException('Firebase is down');
        }
        $this->sent[] = compact('topic', 'title', 'body', 'data', 'imageUrl');
    }
}

class DevotionNotificationTest extends TestCase
{
    private FakePush $push;

    protected function setUp(): void
    {
        parent::setUp();
        $base = dirname(__DIR__, 2);
        Artisan::call('migrate:fresh', [
            '--realpath' => true,
            '--path' => [
                "$base/database/migrations/2024_01_01_000000_create_users_table.php",
                "$base/database/migrations/2025_12_06_000002_add_permissions_to_users_table.php",
                // The dashboard layout counts unread contact messages and prayer requests.
                "$base/database/migrations/2024_01_01_000002_create_contact_submissions_table.php",
                "$base/database/migrations/2024_01_01_000006_create_prayer_requests_table.php",
                "$base/database/migrations/2026_10_17_000001_create_members_table.php",
                "$base/database/migrations/2026_10_17_000002_create_app_users_table.php",
                "$base/database/migrations/2026_10_18_000001_create_devotionals_tables.php",
                "$base/database/migrations/2026_10_26_000001_add_notification_fields_to_devotionals.php",
            ],
        ]);
        $this->travelTo(Carbon::parse('2026-03-10 05:45:00', 'UTC')); // Ghana is UTC+0
        config(['devotion.timezone' => 'Africa/Accra']);

        $this->push = new FakePush();
        $this->app->instance(PushNotifier::class, $this->push);
    }

    private function devotional(array $over = []): Devotional
    {
        return Devotional::create($over + [
            'publish_date' => '2026-03-10', 'title' => 'Walking by faith', 'scripture_reference' => '2 Cor 5:7',
            'reflection' => '<p>Reflect.</p>', 'published' => true, 'notify' => true,
        ]);
    }

    private function staff(): User
    {
        $u = new User(['name' => 'Admin', 'email' => 'a@example.com', 'password' => 'x', 'role' => 'admin']);
        $u->is_active = true;
        $u->save();

        return $u;
    }

    public function test_morning_command_sends_todays_devotional_once_to_everyone(): void
    {
        $d = $this->devotional();

        $this->artisan('devotions:notify')->assertSuccessful();
        $this->artisan('devotions:notify')->assertSuccessful(); // next scheduler run: already sent

        $this->assertCount(1, $this->push->sent);
        $this->assertSame([
            'topic' => 'devotions',
            'title' => "Today's devotion",
            'body' => 'Walking by faith · 2 Cor 5:7',
            'data' => ['type' => 'devotion', 'devotional_id' => $d->id, 'date' => '2026-03-10'],
            'imageUrl' => null,
        ], $this->push->sent[0]);
        $this->assertNotNull($d->fresh()->notified_at);
    }

    public function test_custom_text_and_image_are_used(): void
    {
        $this->devotional(['notification_title' => 'Good morning, Peyer!', 'notification_body' => 'Faith over fear.', 'thumbnail' => 'devotionals/a.jpg']);

        $this->artisan('devotions:notify');

        $this->assertSame('Good morning, Peyer!', $this->push->sent[0]['title']);
        $this->assertSame('Faith over fear.', $this->push->sent[0]['body']);
        $this->assertSame(asset('storage/devotionals/a.jpg'), $this->push->sent[0]['imageUrl']);
    }

    public function test_nothing_is_sent_for_drafts_switched_off_days_or_other_dates(): void
    {
        $this->devotional(['published' => false]);
        $this->devotional(['publish_date' => '2026-03-11']);
        $this->artisan('devotions:notify')->assertSuccessful();

        Devotional::whereDate('publish_date', '2026-03-10')->update(['published' => true, 'notify' => false]);
        $this->artisan('devotions:notify')->assertSuccessful();

        $this->assertSame([], $this->push->sent);
    }

    public function test_a_failed_send_is_retried_on_the_next_run(): void
    {
        $d = $this->devotional();
        $this->push->fail = true;
        $this->artisan('devotions:notify')->assertFailed();
        $this->assertNull($d->fresh()->notified_at);

        $this->push->fail = false;
        $this->artisan('devotions:notify')->assertSuccessful();
        $this->assertCount(1, $this->push->sent);
    }

    public function test_scheduler_checks_every_15_minutes_in_the_morning_window(): void
    {
        $event = collect($this->app->make(Schedule::class)->events())
            ->first(fn ($e) => str_contains($e->command ?? '', 'devotions:notify'));

        $this->assertNotNull($event);
        $this->assertSame('*/15 * * * *', $event->expression);
        $this->assertSame('Africa/Accra', $event->timezone);
    }

    public function test_admin_creates_a_devotional_with_image_and_notification_text(): void
    {
        Storage::fake('public');
        $this->actingAs($this->staff());

        $this->post(route('dashboard.devotionals.store'), [
            'publish_date' => '2026-03-12', 'title' => 'Rest', 'scripture_reference' => 'Matt 11:28',
            'reflection' => '<p>Come.</p>', 'published' => '1', 'notify' => '1',
            'notification_title' => 'Come to Me', 'thumbnail' => UploadedFile::fake()->image('rest.jpg'),
        ])->assertRedirect(route('dashboard.devotionals.index'));

        $d = Devotional::firstOrFail();
        $this->assertTrue($d->notify);
        $this->assertSame('Come to Me', $d->notification_title);
        Storage::disk('public')->assertExists($d->thumbnail);

        $this->get(route('dashboard.devotionals.index'))->assertOk()
            ->assertSee('Next 7 days')->assertSee('Rest')->assertSee('Nothing yet')
            ->assertSee('Morning notifications are on');
        $this->get(route('dashboard.devotionals.edit', $d))->assertOk()->assertSee('Morning notification')->assertSee('Come to Me');
    }

    public function test_admin_send_now_and_missing_key_warning(): void
    {
        $d = $this->devotional();
        $this->actingAs($this->staff());

        $this->post(route('dashboard.devotionals.notify', $d))->assertSessionHas('success');
        $this->post(route('dashboard.devotionals.notify', $d))->assertSessionHas('success'); // "Send again"
        $this->assertCount(2, $this->push->sent);

        $this->push->configured = false;
        $this->get(route('dashboard.devotionals.index'))->assertSee('Push notifications are not set up yet');
    }

    public function test_fcm_signs_in_with_the_service_account_and_sends_to_the_topic(): void
    {
        $pem = '';
        // XAMPP's PHP needs its openssl.cnf to generate keys.
        $conf = array_filter(['config' => getenv('OPENSSL_CONF') ?: (is_file(dirname(PHP_BINARY) . '/extras/ssl/openssl.cnf') ? dirname(PHP_BINARY) . '/extras/ssl/openssl.cnf' : null)]);
        openssl_pkey_export(openssl_pkey_new(['private_key_bits' => 2048] + $conf), $pem, null, $conf);
        $path = tempnam(sys_get_temp_dir(), 'sa');
        file_put_contents($path, json_encode(['client_email' => 'push@pcg.iam.gserviceaccount.com', 'private_key' => $pem,
            'token_uri' => 'https://oauth2.googleapis.com/token']));
        Cache::flush();
        $requests = [];
        $post = function (string $url, array $headers, string $body) use (&$requests) {
            $requests[] = compact('url', 'headers', 'body');

            return str_contains($url, 'oauth2') ? [200, ['access_token' => 'tok-123']] : [200, ['name' => 'projects/p/messages/1']];
        };

        (new FcmPushNotifier('pcg-peyer-app-4a8d4', $path, $post))->sendToTopic('devotions', 'Hi', 'Body', ['id' => 5]);

        [$auth, $send] = $requests;
        parse_str($auth['body'], $form);
        $this->assertSame('https://oauth2.googleapis.com/token', $auth['url']);
        $this->assertCount(3, explode('.', $form['assertion'])); // a signed JWT
        $this->assertSame('https://fcm.googleapis.com/v1/projects/pcg-peyer-app-4a8d4/messages:send', $send['url']);
        $this->assertContains('Authorization: Bearer tok-123', $send['headers']);
        $message = json_decode($send['body'], true)['message'];
        $this->assertSame('devotions', $message['topic']);
        $this->assertSame(['id' => '5'], $message['data']);
        unlink($path);
    }

    public function test_fcm_reports_a_missing_key_clearly(): void
    {
        $this->expectExceptionMessage('service-account key is missing');
        (new FcmPushNotifier('p', '/nope/missing.json'))->sendToTopic('devotions', 'Hi', 'Body');
    }
}
