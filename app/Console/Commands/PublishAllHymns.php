<?php

namespace App\Console\Commands;

use App\Models\Hymn;
use App\Models\HymnVerse;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Makes every imported hymn available at once (church decision, Oct 2026).
 * Verses are approved but keep their `flags`, so the dashboard's "Flagged" filter still lists
 * the ones that need a Ga/Twi reader. One file is published per hymn number.
 */
class PublishAllHymns extends Command
{
    protected $signature = 'hymns:publish-all {--dry-run : Report what would happen without saving}';

    protected $description = 'Approve all hymn verses (keeping review flags) and publish one hymn per number';

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');
        $hymns = Hymn::withCount('verses')->orderBy('number')->orderBy('id')->get();

        $published = 0;
        $duplicates = [];

        $work = function () use ($hymns, &$published, &$duplicates) {
            HymnVerse::where('review_status', '!=', 'approved')->update(['review_status' => 'approved']);

            foreach ($hymns->groupBy('number') as $number => $files) {
                // Prefer a file without a variant note ("HYMN 101.ppt" over "HYMN 101ppt.ppt"), then the oldest row.
                $chosen = $files->filter(fn ($h) => $h->verses_count > 0)
                    ->sortBy(fn ($h) => [$h->import_notes === null ? 0 : 1, $h->id])->first();
                if (!$chosen) {
                    continue;
                }
                if ($files->count() > 1) {
                    $duplicates[] = $number . ': ' . $files->pluck('source_file')->implode(', ') . ' -> ' . $chosen->source_file;
                }
                Hymn::where('number', $number)->where('id', '!=', $chosen->id)->update(['status' => 'draft', 'published_at' => null]);
                if ($chosen->status !== 'published') {
                    $chosen->update(['status' => 'published', 'published_at' => now()]);
                }
                $published++;
            }
        };

        if ($dry) {
            DB::beginTransaction();
            $work();
            DB::rollBack();
        } else {
            DB::transaction($work);
        }

        $flagged = HymnVerse::whereNotNull('flags')->count();
        $this->info(($dry ? '[dry run] ' : '') . "Hymn numbers published: {$published}");
        $this->line("Verses still flagged for a reader to check: {$flagged}");
        foreach ($duplicates as $d) {
            $this->warn("Several files for {$d}");
        }

        return self::SUCCESS;
    }
}
