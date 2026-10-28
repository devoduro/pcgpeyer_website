<?php

namespace Database\Seeders;

use App\Models\Devotional;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

/**
 * Schedules one devotional per day for the next year from C. H. Spurgeon's
 * "Morning and Evening" (public domain), matching each date to its morning reading.
 * Days that already have a devotional are left untouched, so it is safe to re-run.
 */
class DevotionalSeeder extends Seeder
{
    public function run(): void
    {
        $readings = collect(json_decode(file_get_contents(__DIR__ . '/data/spurgeon_morning.json'), true))
            ->keyBy(fn ($r) => sprintf('%02d-%02d', $r['month'], $r['day']));

        $day = CarbonImmutable::now(config('devotion.timezone'))->startOfDay();
        $last = $day->addYear();
        $created = 0;

        for (; $day->lessThan($last); $day = $day->addDay()) {
            $reading = $readings[$day->format('m-d')];

            $devotional = Devotional::firstOrCreate(
                ['publish_date' => $day->toDateString()],
                [
                    'title' => $reading['title'],
                    'scripture_reference' => $reading['scripture_reference'],
                    'scripture_text' => $reading['scripture_text'],
                    'reflection' => $reading['reflection'],
                    'author' => 'C. H. Spurgeon, Morning and Evening',
                    'published' => true,
                ]
            );

            $created += $devotional->wasRecentlyCreated ? 1 : 0;
        }

        $this->command->info("Devotionals scheduled: {$created} new.");
    }
}
