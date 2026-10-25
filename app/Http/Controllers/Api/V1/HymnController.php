<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Hymn;
use App\Models\HymnVerse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** Only published hymns and approved verses are ever returned. */
class HymnController extends Controller
{
    /** GET /hymns?language=tw&q=praise&page=1  - list with number and first line. */
    public function index(Request $request): JsonResponse
    {
        $data = $request->validate([
            'language' => ['nullable', 'in:ga,tw,en'],
            'q' => ['nullable', 'string', 'max:100'],
        ]);
        $lang = $data['language'] ?? 'en';
        $q = trim($data['q'] ?? '');

        $query = Hymn::published()->whereHas('verses', fn ($v) => $v->where('language', $lang)->where('review_status', 'approved'));

        if ($q !== '') {
            if (ctype_digit($q)) {
                $query->where('number', (int) $q);
            } else {
                $like = '%' . str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $q) . '%';
                $query->whereHas('verses', fn ($v) => $v->where('language', $lang)
                    ->where('review_status', 'approved')->where('text', 'like', $like));
            }
        }

        $page = $query->orderBy('number')->paginate(50);

        $firstLines = HymnVerse::whereIn('hymn_id', $page->pluck('id'))
            ->where('language', $lang)->where('review_status', 'approved')
            ->orderBy('position')->orderBy('id')->get()->groupBy('hymn_id')
            ->map(fn ($verses) => strtok($verses->first()->text, "\n"));

        return response()->json([
            'language' => $lang,
            'data' => $page->map(fn ($h) => [
                'id' => $h->id,
                'number' => $h->number,
                'first_line' => $firstLines[$h->id] ?? null,
                'author' => $h->author,
            ]),
            'meta' => ['page' => $page->currentPage(), 'last_page' => $page->lastPage(), 'total' => $page->total()],
        ]);
    }

    /**
     * GET /hymns/sync?since=<as_of>&as_of=<snapshot>&page=1
     *
     * Delta download for offline use. First call: no `since` (full copy). Later calls: pass the `as_of`
     * returned by the last COMPLETED sync as `since`. While paging through one sync, pass the first
     * response's `as_of` back as `as_of` so every page reads the same snapshot.
     * Responses include changed hymns (all three languages, approved verses only) and `removed` hymn
     * numbers that are no longer published. Re-receiving a hymn is harmless: clients upsert by number.
     */
    public function sync(Request $request): JsonResponse
    {
        if (!config('hymns.offline_sync_enabled')) {
            return response()->json(['message' => 'Offline hymns are not enabled.', 'code' => 'offline_disabled'], 403);
        }

        $data = $request->validate([
            'since' => ['nullable', 'date'],
            'as_of' => ['nullable', 'date'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $asOf = isset($data['as_of']) ? Carbon::parse($data['as_of']) : now();
        $since = isset($data['since']) ? Carbon::parse($data['since']) : null;

        $changed = Hymn::published()->where('updated_at', '<=', $asOf)
            ->when($since, fn ($q) => $q->where('updated_at', '>=', $since))
            ->with(['verses' => fn ($v) => $v->where('review_status', 'approved')])
            ->orderBy('number')->orderBy('id')
            ->paginate(config('hymns.sync_page_size'));

        $removed = [];
        if ($since) {
            $stillPublished = Hymn::published()->pluck('number');
            $removed = Hymn::where('status', '!=', 'published')
                ->where('updated_at', '>=', $since)->where('updated_at', '<=', $asOf)
                ->pluck('number')->unique()->diff($stillPublished)->values();
        }

        return response()->json([
            'as_of' => $asOf->toIso8601String(),
            'full' => $since === null,
            'page' => $changed->currentPage(),
            'last_page' => $changed->lastPage(),
            'next_page' => $changed->hasMorePages() ? $changed->currentPage() + 1 : null,
            'hymns' => $changed->getCollection()->map(fn ($h) => [
                'number' => $h->number,
                'author' => $h->author,
                'updated_at' => $h->updated_at->toIso8601String(),
                'languages' => collect(['ga', 'tw', 'en'])->mapWithKeys(fn ($lang) => [
                    $lang => $h->verses->where('language', $lang)->sortBy([['position', 'asc'], ['id', 'asc']])->values()
                        ->map(fn ($v) => ['label' => $v->label, 'text' => $v->text]),
                ])->filter(fn ($verses) => $verses->isNotEmpty()),
            ])->values(),
            'removed' => $removed,
        ]);
    }

    /** GET /hymns/{number}?language=tw - one hymn in one language, plus which languages exist. */
    public function show(Request $request, int $number): JsonResponse
    {
        $data = $request->validate(['language' => ['nullable', 'in:ga,tw,en']]);
        $lang = $data['language'] ?? 'en';

        $hymn = Hymn::published()->where('number', $number)->first();
        if (!$hymn) {
            abort(404);
        }

        $approved = $hymn->verses()->where('review_status', 'approved')->get();
        $available = $approved->pluck('language')->unique()->values();
        $verses = $approved->where('language', $lang)->values();
        if ($verses->isEmpty()) {
            return response()->json(['message' => 'This hymn is not available in that language.', 'available_languages' => $available], 404);
        }

        return response()->json([
            'hymn' => [
                'number' => $hymn->number,
                'author' => $hymn->author,
                'language' => $lang,
                'available_languages' => $available,
                'verses' => $verses->map(fn ($v) => ['label' => $v->label, 'text' => $v->text]),
            ],
        ]);
    }
}
