<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Hymn;
use App\Models\HymnVerse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HymnController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $q = trim((string) $request->query('q', ''));

        $hymns = Hymn::withCount([
            'verses',
            'verses as pending_count' => fn ($v) => $v->where('review_status', '!=', 'approved'),
            'verses as flagged_count' => fn ($v) => $v->whereNotNull('flags'),
        ])
            ->when($q !== '' && ctype_digit($q), fn ($h) => $h->where('number', (int) $q))
            ->when($filter === 'pending', fn ($h) => $h->whereHas('verses', fn ($v) => $v->where('review_status', '!=', 'approved')))
            ->when($filter === 'ready', fn ($h) => $h->where('status', 'draft')->whereDoesntHave('verses', fn ($v) => $v->where('review_status', '!=', 'approved')))
            ->when($filter === 'published', fn ($h) => $h->where('status', 'published'))
            ->when($filter === 'flagged', fn ($h) => $h->whereHas('verses', fn ($v) => $v->whereNotNull('flags')))
            ->orderBy('number')->orderBy('id')
            ->paginate(40)->withQueryString();

        $stats = [
            'total' => Hymn::count(),
            'published' => Hymn::where('status', 'published')->count(),
            'pending_verses' => HymnVerse::where('review_status', '!=', 'approved')->count(),
        ];

        return view('dashboard.hymns.index', compact('hymns', 'filter', 'q', 'stats'));
    }

    public function edit(Hymn $hymn)
    {
        $hymn->load('verses');
        // Group by slide position so Ga / Twi / English sit side by side.
        $rows = $hymn->verses->groupBy('position');

        return view('dashboard.hymns.edit', compact('hymn', 'rows'));
    }

    /** Save corrected text and approval for every verse on the page in one go. */
    public function update(Request $request, Hymn $hymn)
    {
        $data = $request->validate([
            'author' => ['nullable', 'string', 'max:255'],
            'verses' => ['array'],
            'verses.*.text' => ['required', 'string'],
            'verses.*.label' => ['nullable', 'string', 'max:40'],
            'verses.*.approved' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($hymn, $data) {
            $hymn->update(['author' => $data['author'] ?? null]);

            foreach ($data['verses'] ?? [] as $id => $v) {
                $verse = $hymn->verses()->whereKey($id)->first();
                if (!$verse) {
                    continue;
                }
                $verse->update([
                    'text' => $v['text'],
                    'label' => $v['label'] ?? $verse->label,
                    'review_status' => !empty($v['approved']) ? 'approved' : 'pending',
                    'flags' => !empty($v['approved']) ? null : $verse->flags,
                ]);
            }

            $hymn->touch(); // verse edits must move the hymn's updated_at: offline sync reads it

            // Editing a published hymn so that anything is unreviewed takes it offline.
            if ($hymn->status === 'published' && $hymn->pendingVerseCount() > 0) {
                $hymn->update(['status' => 'draft', 'published_at' => null]);
            }
        });

        return back()->with('success', 'Hymn saved.');
    }

    public function togglePublish(Hymn $hymn)
    {
        if ($hymn->status === 'published') {
            $hymn->update(['status' => 'draft', 'published_at' => null]);

            return back()->with('success', 'Hymn unpublished.');
        }

        if ($hymn->verses()->count() === 0 || $hymn->pendingVerseCount() > 0) {
            return back()->with('error', 'Approve every verse before publishing.');
        }

        // Only one published version per hymn number (the other files are duplicates).
        DB::transaction(function () use ($hymn) {
            Hymn::where('number', $hymn->number)->where('id', '!=', $hymn->id)
                ->update(['status' => 'draft', 'published_at' => null]);
            $hymn->update(['status' => 'published', 'published_at' => now()]);
        });

        return back()->with('success', 'Hymn published.');
    }

    /** Staff download of the original PowerPoint the hymn was imported from (kept in private storage). */
    public function source(Hymn $hymn)
    {
        $path = self::sourcePath($hymn);
        abort_if($path === null, 404);

        return response()->download($path, $hymn->source_file, ['Content-Type' => 'application/vnd.ms-powerpoint']);
    }

    /** Absolute path of the hymn's original slide file, or null if it is not stored. */
    public static function sourcePath(Hymn $hymn): ?string
    {
        if (!$hymn->source_file) {
            return null;
        }
        // basename() keeps lookups inside the folder whatever the stored name contains.
        $path = storage_path('app/hymn-sources/ppt/' . basename($hymn->source_file));

        return is_file($path) ? $path : null;
    }

    public function destroy(Hymn $hymn)
    {
        if ($hymn->status === 'published') {
            return back()->with('error', 'Unpublish the hymn before deleting it.');
        }
        $hymn->delete();

        return redirect(route('dashboard.hymns.index'))->with('success', 'Hymn deleted.');
    }
}
