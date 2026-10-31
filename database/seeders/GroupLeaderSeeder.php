<?php

namespace Database\Seeders;

use App\Models\GroupLeader;
use App\Models\Ministry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Executives of the Men's and Women's Fellowships, YAF and YPG, from the October 2026 photo shoot.
 * Photos are bundled in public/images/group-leaders. Safe to re-run: a group that already has
 * leaders (seeded earlier or entered in the dashboard) is left alone.
 *
 * Names come from the photo file names and the positions from the YAF sashes; the other groups'
 * positions were not supplied, so they are left blank for the dashboard. Photos that came without
 * a name are imported hidden, to be named and switched on in the dashboard.
 */
class GroupLeaderSeeder extends Seeder
{
    /** Ministry slug => [photo, name, position], in the order they are listed. */
    private const LEADERS = [
        'mens-fellowship' => [
            ['men/alexander-asare', 'Alexander Asare', null],
            ['men/boasiako', 'Boasiako', null],
            ['men/edward-nii-annan', 'Edward Nii Annan', null],
            ['men/emmanuel-kofi-agyekum', 'Emmanuel Kofi Agyekum', null],
            ['men/sampson-ofori-tendu', 'Sampson Ofori Tendu', null],
            ['men/img-7483', null, null],
            ['men/img-7484', null, null],
            ['men/img-7503', null, null],
            ['men/img-7511', null, null],
            ['men/img-7514', null, null],
        ],
        'womens-fellowship' => [
            ['women/agatha-agyekum-badu', 'Agatha Agyekum-Badu', null],
            ['women/anna-afua-afrifa-duah', 'Anna Afua Afrifa Duah', null],
            ['women/diana-animah-yeboah', 'Diana Animah Yeboah', null],
            ['women/evelyn-baah-amankwah', 'Evelyn Baah Amankwah', null],
            ['women/georgina-aning-badu', 'Georgina Aning Badu', null],
            ['women/gladys-adwoa-offei', 'Gladys Adwoa Offei', null],
        ],
        'young-adult-fellowship-yaf' => [
            ['yaf/kofi', 'Kofi', 'President'],
            ['yaf/mirabel', 'Mirabel', 'Vice President'],
            ['yaf/gideon', 'Gideon', 'Secretary'],
            ['yaf/joseph', 'Joseph', 'Assistant Secretary'],
            ['yaf/img-7534', null, 'Financial Secretary'],
            ['yaf/tieku', 'Tieku', 'Organizing Secretary'],
            ['yaf/yaa', 'Yaa', 'Treasurer'],
            ['yaf/elizabeth', 'Elizabeth', "Women's Commissioner"],
        ],
        'young-peoples-guild-ypg' => [
            ['ypg/adom-ofori-emmanuel', 'Adom Ofori Emmanuel', 'Assistant President'],
            ['ypg/aku', 'Aku', null],
            ['ypg/amma', 'Amma', null],
            ['ypg/bernice', 'Bernice', null],
            ['ypg/francis', 'Francis', null],
            ['ypg/ishaque', 'Ishaque', null],
            ['ypg/michelle', 'Michelle', null],
        ],
    ];

    public function run(): void
    {
        DB::transaction(function () {
            foreach (self::LEADERS as $slug => $leaders) {
                $ministry = Ministry::where('slug', $slug)->first();
                if (! $ministry) {
                    $this->command->warn("Group leaders: no ministry '{$slug}', skipped.");
                    continue;
                }
                if ($ministry->leaders()->exists()) {
                    $this->command->info("Group leaders: {$ministry->name} already has leaders, left alone.");
                    continue;
                }

                foreach ($leaders as $order => [$photo, $name, $position]) {
                    GroupLeader::create([
                        'ministry_id' => $ministry->id,
                        'name' => $name ?? 'Unnamed (photo ' . strtoupper(basename($photo)) . ')',
                        'position' => $position,
                        'photo' => $this->publish($photo),
                        'display_order' => $order + 1,
                        'active' => $name !== null,
                    ]);
                }
                $this->command->info("Group leaders: {$ministry->name}, " . count($leaders) . ' leaders.');
            }
        });
    }

    /** Copies a bundled photo from public/images/group-leaders onto the public disk and returns its path. */
    private function publish(string $photo): string
    {
        $path = "group-leaders/{$photo}.jpg";
        if (! Storage::disk('public')->exists($path)) {
            Storage::disk('public')->put($path, file_get_contents(public_path("images/group-leaders/{$photo}.jpg")));
        }

        return $path;
    }
}
