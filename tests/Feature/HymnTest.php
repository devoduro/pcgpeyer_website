<?php

namespace Tests\Feature;

use App\Models\Hymn;
use App\Models\User;
use App\Support\HymnImporter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class HymnTest extends TestCase
{
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
    }

    private function shape(int $left, string $text, string $font = 'Calibri'): array
    {
        return ['left' => $left, 'top' => 0, 'runs' => [['font' => $font, 'text' => $text]]];
    }

    /** A realistic trilingual file: title slide + one verse slide. */
    private function file(string $name = 'HYMN 300.ppt'): array
    {
        return ['file' => $name, 'slides' => [
            ['n' => 1, 'shapes' => [$this->shape(0, "\x0b\x0bHYMN \x0b300\x0bNicholas Zinzendorf, 1700-1760\x0b")]],
            ['n' => 2, 'shapes' => [
                $this->shape(0, "Mâi diji kâ blôfomâi lâ\rNyôåmô", 'Ghana Charis'),
                $this->shape(240, "Yân ti ne Agyenkwa\rNyankopôn", 'Ghana Charis'),
                $this->shape(12, 'GA'), $this->shape(257, 'TWI'), $this->shape(488, 'ENGLISH'),
                $this->shape(12, 'Verse 1A'),
                $this->shape(488, "Hearts united in Christ,\rwe have fellowship", 'Times New Roman'),
            ]],
        ]];
    }

    private function importOne(array $file = null): Hymn
    {
        (new HymnImporter())->import([$file ?? $this->file()]);

        return Hymn::firstOrFail();
    }

    public function test_importer_maps_languages_by_label_position_and_converts_known_fonts(): void
    {
        $hymn = $this->importOne();

        $this->assertSame(300, $hymn->number);
        $this->assertSame('Nicholas Zinzendorf, 1700-1760', $hymn->author);
        $this->assertSame('draft', $hymn->status);

        $v = $hymn->verses->keyBy('language');
        $this->assertSame("Mɛi diji kɛ blɔfomɛi lɛ\nNyɔŋmɔ", $v['ga']->text);
        $this->assertSame("Yɛn ti ne Agyenkwa\nNyankopɔn", $v['tw']->text);
        $this->assertSame("Hearts united in Christ,\nwe have fellowship", $v['en']->text);
        $this->assertSame('Verse 1A', $v['en']->label);
    }

    public function test_raw_text_is_kept_unchanged_and_nothing_is_auto_approved(): void
    {
        $hymn = $this->importOne();

        $ga = $hymn->verses->firstWhere('language', 'ga');
        $this->assertStringContainsString('Nyôåmô', $ga->raw_text);
        $this->assertSame('pending', $ga->review_status);
        $this->assertSame(0, $hymn->verses->where('review_status', 'approved')->count());
    }

    public function test_unresolved_encodings_and_guessed_languages_are_flagged(): void
    {
        $file = ['file' => 'HYMN 5.ppt', 'slides' => [
            ['n' => 1, 'shapes' => [$this->shape(0, 'HYMN 5')]],
            ['n' => 2, 'shapes' => [$this->shape(0, "Monkamfo Nyankopôn mo anom", 'Unknown Font')]],
        ]];
        $hymn = $this->importOne($file);

        $verse = $hymn->verses->first();
        $this->assertSame('tw', $verse->language);
        $this->assertStringContainsString('language_guessed', $verse->flags);
        $this->assertStringContainsString('suspect_chars', $verse->flags); // ô left untouched, not guessed
        $this->assertStringContainsString('ô', $verse->text);
    }

    public function test_unreadable_and_numberless_files_are_skipped_not_imported(): void
    {
        $r = (new HymnImporter())->import([
            ['file' => 'HYMN 7.ppt', 'error' => 'could not open'],
            ['file' => 'notes.ppt', 'slides' => [['n' => 1, 'shapes' => [$this->shape(0, 'no number here')]]]],
            $this->file(),
        ]);

        $this->assertSame(1, $r['imported']);
        $this->assertCount(2, $r['skipped']);
    }

    public function test_dry_run_saves_nothing_and_reimport_does_not_duplicate(): void
    {
        (new HymnImporter(true))->import([$this->file()]);
        $this->assertSame(0, Hymn::count());

        (new HymnImporter())->import([$this->file()]);
        (new HymnImporter())->import([$this->file()]);
        $this->assertSame(1, Hymn::count());
        $this->assertSame(3, Hymn::first()->verses()->count());
    }

    public function test_reimport_never_overwrites_a_reviewed_hymn(): void
    {
        $hymn = $this->importOne();
        $hymn->verses()->first()->update(['text' => 'Corrected by reviewer', 'review_status' => 'approved']);

        (new HymnImporter())->import([$this->file()]);

        $this->assertSame('Corrected by reviewer', $hymn->verses()->first()->text);
    }

    private function staff(): User
    {
        $u = new User(['name' => 'Admin', 'email' => 'a@example.com', 'password' => 'x', 'role' => 'admin']);
        $u->is_active = true;
        $u->save();

        return $u;
    }

    public function test_review_screens_render_for_staff_and_not_for_guests(): void
    {
        $hymn = $this->importOne();

        $this->get(route('dashboard.hymns.index'))->assertRedirect(route('dashboard.login'));

        $this->actingAs($this->staff());
        $this->get(route('dashboard.hymns.index'))->assertOk()->assertSee('300')->assertSee('HYMN 300.ppt');
        $this->get(route('dashboard.hymns.index', ['filter' => 'pending']))->assertOk()->assertSee('3 pending');
        $this->get(route('dashboard.hymns.edit', $hymn))->assertOk()->assertSee('Nyôåmô')->assertSee('Verse 1A');
    }

    public function test_publishing_requires_every_verse_approved_and_only_one_version_per_number(): void
    {
        $this->actingAs($this->staff());
        $a = $this->importOne($this->file('HYMN 300.ppt'));
        (new HymnImporter())->import([$this->file('HYMN 300ppt.ppt')]);
        $b = Hymn::where('source_file', 'HYMN 300ppt.ppt')->first();

        $this->post(route('dashboard.hymns.toggle-publish', $a))->assertSessionHas('error');
        $this->assertSame('draft', $a->fresh()->status);

        foreach ([$a, $b] as $h) {
            $h->verses()->update(['review_status' => 'approved']);
        }
        $this->post(route('dashboard.hymns.toggle-publish', $a))->assertSessionHas('success');
        $this->post(route('dashboard.hymns.toggle-publish', $b))->assertSessionHas('success');

        $this->assertSame('draft', $a->fresh()->status);
        $this->assertSame('published', $b->fresh()->status);
    }

    public function test_editing_a_published_hymn_with_unapproved_verse_takes_it_offline(): void
    {
        $this->actingAs($this->staff());
        $hymn = $this->importOne();
        $hymn->verses()->update(['review_status' => 'approved']);
        $hymn->update(['status' => 'published']);

        $payload = ['author' => 'X', 'verses' => $hymn->verses->mapWithKeys(
            fn ($v) => [$v->id => ['text' => $v->text, 'label' => $v->label]] // approved box left unticked
        )->all()];
        $this->put(route('dashboard.hymns.update', $hymn), $payload)->assertSessionHas('success');

        $this->assertSame('draft', $hymn->fresh()->status);
    }

    private function appToken(): string
    {
        return $this->postJson('/api/v1/auth/register', [
            'name' => 'Ama', 'email' => 'ama@example.com', 'phone' => '0200111222',
            'password' => 'secret-pass-1', 'password_confirmation' => 'secret-pass-1',
        ])->json('token');
    }

    private function publish(Hymn $hymn): void
    {
        $hymn->verses()->update(['review_status' => 'approved']);
        $hymn->update(['status' => 'published']);
    }

    public function test_api_only_serves_published_and_approved_content(): void
    {
        $token = $this->appToken();
        $hymn = $this->importOne();

        // Draft: invisible
        $this->withToken($token)->getJson('/api/v1/hymns?language=tw')->assertOk()->assertJsonCount(0, 'data');
        $this->withToken($token)->getJson('/api/v1/hymns/300?language=tw')->assertNotFound();

        $this->publish($hymn);
        $hymn->verses()->where('language', 'ga')->update(['review_status' => 'pending']); // Ga not reviewed yet

        $this->withToken($token)->getJson('/api/v1/hymns?language=tw')
            ->assertOk()->assertJsonPath('data.0.number', 300)->assertJsonPath('data.0.first_line', 'Yɛn ti ne Agyenkwa');
        $this->withToken($token)->getJson('/api/v1/hymns/300?language=tw')
            ->assertOk()->assertJsonPath('hymn.verses.0.label', 'Verse 1A');
        $this->withToken($token)->getJson('/api/v1/hymns/300?language=ga')
            ->assertNotFound()->assertJsonPath('available_languages', ['tw', 'en']);
        $this->withToken($token)->getJson('/api/v1/hymns?language=ga')->assertJsonCount(0, 'data');
    }

    public function test_api_search_by_number_and_text_and_raw_text_not_exposed(): void
    {
        $token = $this->appToken();
        $this->publish($this->importOne());

        $this->withToken($token)->getJson('/api/v1/hymns?language=en&q=300')->assertJsonCount(1, 'data');
        $this->withToken($token)->getJson('/api/v1/hymns?language=en&q=fellowship')->assertJsonCount(1, 'data');
        $this->withToken($token)->getJson('/api/v1/hymns?language=en&q=zzz')->assertJsonCount(0, 'data');
        $this->withToken($token)->getJson('/api/v1/hymns?language=en&q=%25')->assertJsonCount(0, 'data'); // wildcard is literal

        $this->assertStringNotContainsString('raw_text', $this->withToken($token)->getJson('/api/v1/hymns/300?language=en')->getContent());
    }

    public function test_hymns_are_locked_by_devotion_first_for_signed_in_users(): void
    {
        config(['devotion.policy' => 'required']);
        $this->travelTo(Carbon::parse('2026-03-10 08:00:00', 'UTC'));
        $token = $this->appToken();
        $this->publish($this->importOne());

        $this->getJson('/api/v1/hymns?language=en')->assertOk(); // guests can read hymns
        $this->withToken($token)->getJson('/api/v1/hymns?language=en')->assertOk(); // no devotional today: no lock

        \App\Models\Devotional::create(['publish_date' => '2026-03-10', 'title' => 'T', 'scripture_reference' => 'J 1:1',
            'reflection' => 'r', 'published' => true]);
        $this->withToken($token)->getJson('/api/v1/hymns?language=en')->assertStatus(423);
        $this->withToken($token)->getJson('/api/v1/hymns/300?language=en')->assertStatus(423);
    }

    public function test_staff_can_download_the_original_slides_only_from_the_sources_folder(): void
    {
        $dir = storage_path('app/hymn-sources/ppt');
        @mkdir($dir, 0777, true);
        $name = 'HYMN 9999 test-only.ppt';
        file_put_contents("$dir/$name", 'ppt-bytes');

        try {
            $hymn = Hymn::create(['number' => 9999, 'source_file' => $name]);
            $missing = Hymn::create(['number' => 9998, 'source_file' => 'HYMN 9998 not-there.ppt']);
            $sneaky = Hymn::create(['number' => 9997, 'source_file' => '../../../.env']);

            $this->get(route('dashboard.hymns.source', $hymn))->assertRedirect(route('dashboard.login'));

            $this->actingAs($this->staff());
            $res = $this->get(route('dashboard.hymns.source', $hymn))->assertOk();
            $this->assertStringContainsString($name, $res->headers->get('content-disposition'));
            $this->get(route('dashboard.hymns.source', $missing))->assertNotFound();
            $this->get(route('dashboard.hymns.source', $sneaky))->assertNotFound();
            $this->get(route('dashboard.hymns.edit', $hymn))->assertOk()->assertSee('Download original slides');
        } finally {
            @unlink("$dir/$name");
        }
    }

    public function test_publish_all_publishes_one_file_per_number_and_keeps_flags(): void
    {
        $flagged = ['file' => 'HYMN 5.ppt', 'slides' => [
            ['n' => 1, 'shapes' => [$this->shape(0, 'HYMN 5')]],
            ['n' => 2, 'shapes' => [$this->shape(0, 'Monkamfo Nyankopôn', 'Unknown Font')]],
        ]];
        (new HymnImporter())->import([$this->file('HYMN 300ppt.ppt'), $this->file('HYMN 300.ppt'), $flagged]);

        $this->artisan('hymns:publish-all --dry-run')->assertSuccessful();
        $this->assertSame(0, Hymn::where('status', 'published')->count());

        $this->artisan('hymns:publish-all')->assertSuccessful();

        // The plain file wins over the "ppt.ppt" variant for number 300.
        $this->assertSame('published', Hymn::where('source_file', 'HYMN 300.ppt')->first()->status);
        $this->assertSame('draft', Hymn::where('source_file', 'HYMN 300ppt.ppt')->first()->status);
        $this->assertSame(2, Hymn::where('status', 'published')->count());
        $this->assertSame(0, \App\Models\HymnVerse::where('review_status', '!=', 'approved')->count());
        // Flagged verses stay findable for a reader.
        $this->assertNotNull(Hymn::where('number', 5)->first()->verses()->first()->flags);
    }
}
