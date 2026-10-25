<?php

namespace App\Support;

use App\Models\Hymn;
use Illuminate\Support\Facades\DB;

/**
 * Turns the extracted PowerPoint data into DRAFT hymns. Nothing is published or approved here.
 *
 * Input shape (one entry per .ppt file):
 *   ['file' => 'HYMN 10.ppt', 'slides' => [['n' => 1, 'shapes' => [['left' => 0, 'top' => 0,
 *       'runs' => [['font' => 'Ghana Charis', 'text' => '...'], ...]], ...]], ...]]
 */
class HymnImporter
{
    /**
     * Legacy Ghanaian font encodings -> Unicode. Only mappings backed by evidence are listed:
     * each was checked against words that also appear in correct Unicode in other slides.
     * Anything not listed is left untouched and flagged for the human reviewer.
     */
    private const FONT_MAPS = [
        'Ghana Charis' => ['â' => 'ɛ', 'ô' => 'ɔ', 'å' => 'ŋ', 'Â' => 'Ɛ', 'Ô' => 'Ɔ', 'Å' => 'Ŋ'],
        'Ghana Doulos' => ['â' => 'ɛ', 'ô' => 'ɔ', 'å' => 'ŋ', 'Â' => 'Ɛ', 'Ô' => 'Ɔ', 'Å' => 'Ŋ'],
        'Capecoast' => ['1' => 'ɛ', '4' => 'ɔ', '`' => 'ŋ'],
        'Times Twi' => ['[' => 'ɔ', ']' => 'ɛ'],
    ];

    /** Characters that suggest an encoding we could not resolve. */
    private const SUSPECT = '/[áàäãâôåÂÔÅ`\[\]]|\p{L}\d|\d\p{L}/u';

    private const LANG_LABELS = ['GA' => 'ga', 'TWI' => 'tw', 'ENGLISH' => 'en', 'ENG' => 'en'];

    public function __construct(private bool $dryRun = false)
    {
    }

    /** @return array{imported:int, skipped:array<int,string>, verses:int, flagged:int} */
    public function import(array $files): array
    {
        $result = ['imported' => 0, 'skipped' => [], 'verses' => 0, 'flagged' => 0];

        foreach ($files as $file) {
            if (isset($file['error']) || empty($file['slides'])) {
                $result['skipped'][] = ($file['file'] ?? '?') . ': could not be read';
                continue;
            }
            $parsed = $this->parseFile($file);
            if ($parsed === null) {
                $result['skipped'][] = $file['file'] . ': no hymn number found';
                continue;
            }
            if (!$parsed['verses']) {
                $result['skipped'][] = $file['file'] . ': no verses found';
                continue;
            }

            $result['imported']++;
            $result['verses'] += count($parsed['verses']);
            $result['flagged'] += count(array_filter($parsed['verses'], fn ($v) => $v['flags']));

            if (!$this->dryRun) {
                $this->store($parsed);
            }
        }

        return $result;
    }

    public function parseFile(array $file): ?array
    {
        $slides = $file['slides'];
        $titleText = $this->shapeText($this->firstShapes($slides[0] ?? []));
        if (!preg_match('/hymn\s*(\d+)/i', $titleText, $m) && !preg_match('/(\d+)/', $file['file'], $m)) {
            return null;
        }
        $number = (int) $m[1];

        // Title slide: "HYMN 300" then the author line(s).
        $author = trim(preg_replace('/\s*hymn\s*\d+\s*/i', '', preg_replace('/[\x0b\r\n]+/', ' ', $titleText)));
        $author = $author !== '' ? $author : null;

        $verses = [];
        foreach (array_slice($slides, 1) as $slide) {
            foreach ($this->parseSlide($slide) as $verse) {
                $verses[] = $verse;
            }
        }

        $notes = null;
        if (preg_match('/\b(again|copy)\b|ppt\.ppt$/i', $file['file'])) {
            $notes = 'Variant file name; check for a duplicate of hymn ' . $number . '.';
        }

        return ['number' => $number, 'author' => $author, 'source_file' => $file['file'], 'notes' => $notes, 'verses' => $verses];
    }

    private function parseSlide(array $slide): array
    {
        $shapes = $this->firstShapes($slide);
        $position = (int) ($slide['n'] ?? 0);

        $langLabels = [];   // left => lang
        $verseLabel = null;
        $content = [];

        foreach ($shapes as $shape) {
            $raw = $this->shapeText([$shape]);
            $trim = trim($raw);
            if ($trim === '') {
                continue;
            }
            $upper = strtoupper($trim);
            if (isset(self::LANG_LABELS[$upper])) {
                $langLabels[(int) $shape['left']] = self::LANG_LABELS[$upper];
            } elseif ($upper === 'EWE') {
                $langLabels[(int) $shape['left']] = 'ga'; // mislabelled in a few files; flagged below
            } elseif (preg_match('/^(verse|chorus|refrain)\b/i', $trim) || preg_match('/^\d+[A-Za-z]?$/', $trim)) {
                $verseLabel ??= preg_replace('/[`\s]+/', ' ', $trim);
            } else {
                $content[] = $shape;
            }
        }

        $out = [];
        $order = ['ga', 'tw', 'en'];
        usort($content, fn ($a, $b) => $a['left'] <=> $b['left']);

        foreach ($content as $i => $shape) {
            $flags = [];
            if ($langLabels) {
                $lang = $this->nearestLanguage((int) $shape['left'], $langLabels);
            } else {
                // No language labels on this slide: guess from order and make the reviewer confirm.
                $lang = count($content) === 1 ? 'tw' : ($order[$i] ?? 'tw');
                $flags[] = 'language_guessed';
            }

            [$text, $raw, $fonts] = $this->convert($shape);
            if ($text === '') {
                continue;
            }
            if (preg_match(self::SUSPECT, $text) && $lang !== 'en') {
                $flags[] = 'suspect_chars';
            }

            $out[] = [
                'language' => $lang,
                'position' => $position,
                'label' => $verseLabel,
                'text' => $text,
                'raw_text' => $raw,
                'source_font' => implode(', ', $fonts) ?: null,
                'flags' => $flags ? implode(',', $flags) : null,
            ];
        }

        return $out;
    }

    private function nearestLanguage(int $left, array $labels): string
    {
        $best = null;
        foreach ($labels as $labelLeft => $lang) {
            $d = abs($labelLeft - $left);
            if ($best === null || $d < $best[0]) {
                $best = [$d, $lang];
            }
        }

        return $best[1];
    }

    /** @return array{0:string,1:string,2:array<int,string>} corrected text, raw text, fonts used */
    private function convert(array $shape): array
    {
        $text = '';
        $raw = '';
        $fonts = [];
        foreach ($shape['runs'] ?? [] as $run) {
            $font = $run['font'] ?? null;
            $part = (string) ($run['text'] ?? '');
            $raw .= $part;
            if ($font) {
                $fonts[$font] = $font;
            }
            $map = $font ? (self::FONT_MAPS[$font] ?? null) : null;
            $text .= $map ? strtr($part, $map) : $part;
        }

        // Slides pad lines with runs of spaces for layout; collapse them in the display text only.
        $text = preg_replace('/[ \t]{2,}/', ' ', $text);
        $text = implode("\n", array_map('trim', explode("\n", $this->tidy($text))));

        return [$this->tidy($text), $this->tidy($raw), array_values($fonts)];
    }

    private function tidy(string $s): string
    {
        $s = preg_replace('/[\r\x0b]+/', "\n", $s);
        $s = preg_replace('/[ \t]+\n/', "\n", $s);

        return trim(preg_replace("/\n{3,}/", "\n\n", $s));
    }

    private function shapeText(array $shapes): string
    {
        $t = '';
        foreach ($shapes as $shape) {
            foreach ($shape['runs'] ?? [] as $run) {
                $t .= $run['text'] ?? '';
            }
        }

        return $t;
    }

    private function firstShapes(array $slide): array
    {
        $shapes = $slide['shapes'] ?? [];
        // PowerShell's JSON collapses a one-item array into an object.
        return isset($shapes['runs']) ? [$shapes] : $shapes;
    }

    private function store(array $p): void
    {
        DB::transaction(function () use ($p) {
            $hymn = Hymn::updateOrCreate(
                ['source_file' => $p['source_file']],
                ['number' => $p['number'], 'author' => $p['author'], 'import_notes' => $p['notes']]
            );

            $hymn->refresh(); // pick up DB defaults (status) on a freshly created row

            // Re-importing refreshes verses only while the hymn is still an untouched draft.
            if ($hymn->status !== 'draft' || $hymn->verses()->where('review_status', 'approved')->exists()) {
                return;
            }
            $hymn->verses()->delete();
            $hymn->verses()->createMany($p['verses']);
        });
    }
}
