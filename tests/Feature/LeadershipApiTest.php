<?php

namespace Tests\Feature;

use App\Models\Leadership;
use App\Models\LeadershipTitle;
use App\Models\LeadershipYear;
use App\Models\Ministry;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LeadershipApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $base = dirname(__DIR__, 2);
        Artisan::call('migrate:fresh', [
            '--realpath' => true,
            '--path' => [
                "$base/database/migrations/2024_01_01_000007_create_ministries_table.php",
                "$base/database/migrations/2025_11_18_075304_add_category_and_age_range_to_ministries_table.php",
                "$base/database/migrations/2025_11_18_081253_add_ministry_leader_and_phone_to_ministries_table.php",
                "$base/database/migrations/2025_12_06_000001_add_leader_picture_to_ministries_table.php",
            ],
        ]);

        // The leadership migrations use MySQL-only ALTER statements, so build the same final columns here.
        Schema::create('leadership_titles', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->text('description')->nullable();
            $t->boolean('active')->default(true);
            $t->timestamps();
        });
        Schema::create('leadership_years', function (Blueprint $t) {
            $t->id();
            $t->integer('year');
            $t->integer('year_end')->nullable();
            $t->text('description')->nullable();
            $t->boolean('active')->default(true);
            $t->timestamps();
        });
        Schema::create('leadership', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->foreignId('title_id')->nullable();
            $t->string('title_text')->default('');
            $t->text('bio')->nullable();
            $t->string('image')->nullable();
            $t->string('email')->nullable();
            $t->string('phone')->nullable();
            $t->integer('year');
            $t->integer('display_order')->default(0);
            $t->boolean('active')->default(true);
            $t->boolean('is_current')->default(false);
            $t->timestamps();
        });

        $minister = LeadershipTitle::create(['title' => 'District Minister']);
        $catechist = LeadershipTitle::create(['title' => 'Catechist']);
        LeadershipYear::create(['year' => 2024, 'year_end' => 2028]);
        LeadershipYear::create(['year' => 1971, 'year_end' => 1978]);

        Leadership::create(['name' => 'Rev. Current Minister', 'title_id' => $minister->id, 'title_text' => '', 'year' => 2024,
            'is_current' => true, 'image' => 'leadership/current.png', 'display_order' => 0]);
        Leadership::create(['name' => 'Elder Session Clerk', 'title_text' => 'Session Clerk', 'year' => 2024, 'is_current' => true, 'display_order' => 1]);
        Leadership::create(['name' => 'Rev. Past Minister', 'title_id' => $minister->id, 'title_text' => '', 'year' => 1971]);
        Leadership::create(['name' => 'Cat. Past Catechist', 'title_id' => $catechist->id, 'title_text' => '', 'year' => 1985]);
        Leadership::create(['name' => 'Hidden Person', 'title_text' => 'Elder', 'year' => 2024, 'active' => false]);

        Ministry::create(['name' => 'Church Choir', 'slug' => 'church-choir', 'description' => 'Choir', 'leader' => 'Sis. Bruce',
            'leader_phone' => '+233 24 123 4567', 'contact_email' => 'choir@example.org', 'ministry_category' => 'Singers',
            'meeting_schedule' => 'Tuesdays 7 PM', 'active' => true]);
        Ministry::create(['name' => 'No Leader Yet', 'slug' => 'no-leader', 'description' => 'x', 'active' => true]);
        Ministry::create(['name' => 'Closed Group', 'slug' => 'closed', 'description' => 'x', 'leader' => 'Someone', 'active' => false]);
    }

    public function test_current_leadership_grouped_by_period_current_first_without_inactive_people(): void
    {
        $res = $this->getJson('/api/v1/leadership')->assertOk()
            ->assertJsonPath('current_period', '2024-2028')
            ->assertJsonPath('periods.0.period', '2024-2028')
            ->assertJsonPath('periods.0.is_current', true)
            ->assertJsonPath('periods.0.leaders.0.name', 'Rev. Current Minister')
            ->assertJsonPath('periods.0.leaders.0.title', 'District Minister')
            ->assertJsonPath('periods.0.leaders.1.title', 'Session Clerk');

        $this->assertStringEndsWith('/storage/leadership/current.png', $res->json('periods.0.leaders.0.image_url'));
        $this->assertSame(['2024-2028', '1985', '1971-1978'], collect($res->json('periods'))->pluck('period')->all());
        $this->assertStringNotContainsString('Hidden Person', $res->getContent());
    }

    public function test_past_leaders_with_categories_and_current_minister(): void
    {
        $res = $this->getJson('/api/v1/leadership/past')->assertOk()
            ->assertJsonPath('current_minister.name', 'Rev. Current Minister')
            ->assertJsonPath('categories', Leadership::MINISTER_CATEGORIES);

        $past = collect($res->json('leaders'));
        $this->assertSame(['Cat. Past Catechist', 'Rev. Past Minister'], $past->pluck('name')->all()); // newest first
        $this->assertSame('Catechists', $past->firstWhere('name', 'Cat. Past Catechist')['category']);
        $this->assertSame('Ministers-in-Charge', $past->firstWhere('name', 'Rev. Past Minister')['category']);
        $this->assertSame('7 years', $past->firstWhere('name', 'Rev. Past Minister')['service_duration']);
        $this->assertFalse($past->contains('is_current', true));
    }

    public function test_group_leadership_lists_active_groups_with_a_leader(): void
    {
        $this->getJson('/api/v1/group-leadership')->assertOk()
            ->assertJsonCount(1, 'groups')
            ->assertJsonPath('groups.0.name', 'Church Choir')
            ->assertJsonPath('groups.0.leader', 'Sis. Bruce')
            ->assertJsonPath('groups.0.category', 'Singers')
            ->assertJsonPath('groups.0.meeting_schedule', 'Tuesdays 7 PM');
    }

    public function test_category_rules_match_the_website(): void
    {
        $this->assertSame('Associate Ministers', Leadership::ministerCategory('Associate Minister'));
        $this->assertSame('Ministers-in-Charge', Leadership::ministerCategory('District Minister'));
        $this->assertSame('Catechists', Leadership::ministerCategory('Catechist'));
        $this->assertSame('Presbyter Sessions', Leadership::ministerCategory('Session Clerk'));
        $this->assertSame('Presbyter Sessions', Leadership::ministerCategory('Youth Rep'));
        $this->assertNull(Leadership::ministerCategory('Organist'));
    }

    public function test_available_without_an_account(): void
    {
        foreach (['/api/v1/leadership', '/api/v1/leadership/past', '/api/v1/group-leadership'] as $url) {
            $this->getJson($url)->assertOk();
        }
    }
}
