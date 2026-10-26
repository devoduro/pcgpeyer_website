<?php

namespace Tests\Feature;

use App\Models\Hymn;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class HymnSyncTest extends TestCase
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
                "$base/database/migrations/2025_12_06_000002_add_permissions_to_users_table.php",
                "$base/database/migrations/2024_01_01_000002_create_contact_submissions_table.php",
                "$base/database/migrations/2024_01_01_000006_create_prayer_requests_table.php",
                "$base/database/migrations/2026_10_17_000001_create_members_table.php",
                "$base/database/migrations/2026_10_17_000002_create_app_users_table.php",
                "$base/database/migrations/2026_10_18_000001_create_devotionals_tables.php",
                "$base/database/migrations/2026_10_19_000001_create_hymns_tables.php",
                "$base/vendor/laravel/sanctum/database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php",
            ],
        ]);

        config(['hymns.offline_sync_enabled' => true, 'devotion.policy' => 'optional', 'hymns.sync_page_size' => 200]);
        $this->travelTo(Carbon::parse('2026-03-10 08:00:00', 'UTC'));

        $this->token = $this->postJson('/api/v1/auth/register', [
            'name' => 'Ama', 'email' => 'ama@example.com', 'phone' => '0200111222',
            'password' => 'secret-pass-1', 'password_confirmation' => 'secret-pass-1',
        ])->json('token');
    }

    private function hymn(int $number, string $status = 'published', array $approved = ['ga', 'tw', 'en'], ?string $file = null): Hymn
    {
        $hymn = Hymn::create(['number' => $number, 'source_file' => $file ?? "HYMN $number.ppt", 'status' => $status]);
        foreach (['ga', 'tw', 'en'] as $lang) {
            foreach ([1, 2] as $pos) {
                $hymn->verses()->create([
                    'language' => $lang, 'position' => $pos, 'label' => "Verse $pos", 'text' => "$lang text $pos of $number",
                    'review_status' => in_array($lang, $approved) ? 'approved' : 'pending',
                ]);
            }
        }

        return $hymn;
    }

    private function sync(array $query = [])
    {
        return $this->withToken($this->token)->getJson('/api/v1/hymns/sync?' . http_build_query($query));
    }

    public function test_sync_is_off_until_licensing_is_confirmed(): void
    {
        config(['hymns.offline_sync_enabled' => false]);
        $this->hymn(1);

        $this->sync()->assertForbidden()->assertJsonPath('code', 'offline_disabled');
    }

    public function test_guests_can_download_hymns_for_offline_use(): void
    {
        $this->hymn(1);
        $this->getJson('/api/v1/hymns/sync')->assertOk()->assertJsonPath('hymns.0.number', 1);
    }

    public function test_full_sync_returns_published_hymns_with_all_languages_and_approved_verses_only(): void
    {
        $this->hymn(1);
        $this->hymn(2, 'draft');
        $this->hymn(3, 'published', ['tw', 'en']); // Ga verses unreviewed (shouldn't happen, but never leak them)

        $r = $this->sync()->assertOk();

        $r->assertJsonPath('full', true)->assertJsonCount(2, 'hymns')->assertJsonPath('removed', []);
        $r->assertJsonPath('hymns.0.number', 1)
            ->assertJsonPath('hymns.0.languages.ga.0.text', 'ga text 1 of 1')
            ->assertJsonPath('hymns.0.languages.en.1.label', 'Verse 2');
        $this->assertSame(['tw', 'en'], array_keys($r->json('hymns.1.languages')));
        $this->assertStringNotContainsString('raw_text', $r->getContent());
    }

    public function test_delta_sync_returns_only_changes_and_reports_removed_numbers(): void
    {
        $a = $this->hymn(1);
        $b = $this->hymn(2);
        $asOf = $this->sync()->json('as_of');

        $this->travel(5)->minutes();
        $b->verses()->where('language', 'en')->first()->update(['text' => 'Corrected English']);
        $b->touch(); // what the dashboard does on save
        $a->update(['status' => 'draft']); // unpublished
        $c = $this->hymn(3); // new

        $r = $this->sync(['since' => $asOf])->assertOk();

        $r->assertJsonPath('full', false);
        $this->assertEqualsCanonicalizing([2, 3], collect($r->json('hymns'))->pluck('number')->all());
        $this->assertSame([1], $r->json('removed'));
        $this->assertSame('Corrected English', collect($r->json('hymns'))->firstWhere('number', 2)['languages']['en'][0]['text']);
        $this->assertNotNull($c);
    }

    public function test_nothing_changed_returns_empty_delta(): void
    {
        $this->hymn(1);
        $this->travel(1)->minutes(); // since uses >=, so rows stamped in the same second as as_of are re-sent (harmless)
        $asOf = $this->sync()->json('as_of');
        $this->travel(5)->minutes();

        $this->sync(['since' => $asOf])->assertOk()->assertJsonCount(0, 'hymns')->assertJsonPath('removed', []);
    }

    public function test_duplicate_file_swap_does_not_remove_the_number(): void
    {
        $old = $this->hymn(101, 'published', file: 'HYMN 101.ppt');
        $new = $this->hymn(101, 'draft', file: 'HYMN 101ppt.ppt');
        $asOf = $this->sync()->json('as_of');

        $this->travel(5)->minutes();
        $old->update(['status' => 'draft']);
        $new->update(['status' => 'published']);

        $r = $this->sync(['since' => $asOf])->assertOk();
        $this->assertSame([], $r->json('removed')); // 101 is still published, just a different file
        $this->assertSame([101], collect($r->json('hymns'))->pluck('number')->all());
    }

    public function test_paging_uses_one_snapshot_and_covers_everything(): void
    {
        config(['hymns.sync_page_size' => 2]);
        foreach ([1, 2, 3, 4, 5] as $n) {
            $this->hymn($n);
        }
        $this->travel(1)->minutes();

        $first = $this->sync()->assertOk();
        $this->assertSame(3, $first->json('last_page'));
        $asOf = $first->json('as_of');
        $numbers = collect($first->json('hymns'))->pluck('number')->all();

        $this->travel(2)->minutes();
        $this->hymn(6); // appears after the snapshot: must not be in this sync, must be in the next

        for ($page = $first->json('next_page'); $page; ) {
            $r = $this->sync(['as_of' => $asOf, 'page' => $page])->assertOk();
            $this->assertSame($asOf, $r->json('as_of'));
            $numbers = array_merge($numbers, collect($r->json('hymns'))->pluck('number')->all());
            $page = $r->json('next_page');
        }
        $this->assertSame([1, 2, 3, 4, 5], $numbers);

        $next = $this->sync(['since' => $asOf])->assertOk();
        $this->assertSame([6], collect($next->json('hymns'))->pluck('number')->all());
    }

    public function test_sync_is_locked_by_devotion_first_like_other_hymn_routes(): void
    {
        config(['devotion.policy' => 'required']);
        $this->hymn(1);
        \App\Models\Devotional::create(['publish_date' => '2026-03-10', 'title' => 'T', 'scripture_reference' => 'J 1:1',
            'reflection' => 'r', 'published' => true]);

        $this->sync()->assertStatus(423);
    }

    public function test_dashboard_save_bumps_updated_at_so_clients_receive_corrections(): void
    {
        $u = new User(['name' => 'Admin', 'email' => 'a@example.com', 'password' => 'x', 'role' => 'admin']);
        $u->is_active = true;
        $u->save();
        $hymn = $this->hymn(7);
        $asOf = $this->sync()->json('as_of');
        $this->travel(5)->minutes();

        $verse = $hymn->verses()->where('language', 'tw')->first();
        $payload = ['author' => null, 'verses' => $hymn->verses->mapWithKeys(fn ($v) => [
            $v->id => ['text' => $v->id === $verse->id ? 'Fixed Twi text' : $v->text, 'label' => $v->label, 'approved' => 1],
        ])->all()];
        $this->actingAs($u)->put(route("dashboard.hymns.update", $hymn), $payload)->assertSessionHas("success");
        $this->app["auth"]->forgetGuards(); // back to token-only API access

        $r = $this->sync(['since' => $asOf])->assertOk();
        $this->assertSame([7], collect($r->json('hymns'))->pluck('number')->all());
        $this->assertSame('Fixed Twi text', $r->json('hymns.0.languages.tw.0.text'));
    }
}
