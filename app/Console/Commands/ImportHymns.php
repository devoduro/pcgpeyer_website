<?php

namespace App\Console\Commands;

use App\Support\HymnImporter;
use Illuminate\Console\Command;

class ImportHymns extends Command
{
    protected $signature = 'hymns:import {file? : JSON extracted from the PowerPoint files (default: storage/app/hymn-sources/hymns_runs.json)} {--dry-run : Parse and report without saving}';

    protected $description = 'Import extracted Ga/Twi/English hymn slides as unpublished drafts';

    public function handle(): int
    {
        $path = $this->argument('file') ?: storage_path('app/hymn-sources/hymns_runs.json');
        if (!is_file($path)) {
            $this->error("File not found: {$path}");
            return self::FAILURE;
        }

        $json = preg_replace('/^\xEF\xBB\xBF/', '', file_get_contents($path)); // strip BOM
        $files = json_decode($json, true);
        if (!is_array($files)) {
            $this->error('Invalid JSON: ' . json_last_error_msg());
            return self::FAILURE;
        }

        $r = (new HymnImporter((bool) $this->option('dry-run')))->import($files);

        $this->info(($this->option('dry-run') ? '[dry run] ' : '') . "Hymn files imported as drafts: {$r['imported']}");
        $this->line("Verses: {$r['verses']}  (flagged for review: {$r['flagged']})");
        foreach ($r['skipped'] as $s) {
            $this->warn("Skipped - {$s}");
        }

        return self::SUCCESS;
    }
}
