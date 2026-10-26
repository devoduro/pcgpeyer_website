<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Sermon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Events, sermons and announcements from the website for the mobile app (replacing the old
 * template backend). Lists use the same shape as /media: items, filter categories, meta.
 */
class ChurchContentController extends Controller
{
    /** GET /events?when=upcoming|past&category=&page= */
    public function events(Request $request): JsonResponse
    {
        $past = $request->query('when') === 'past';
        $query = Event::published()->where('start_date', $past ? '<' : '>=', now()->startOfDay());
        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }
        $page = ($past ? $query->orderByDesc('start_date') : $query->orderBy('start_date'))->paginate(20);

        return response()->json([
            'categories' => Event::published()->whereNotNull('category')->distinct()->orderBy('category')->pluck('category'),
            'events' => collect($page->items())->map(fn (Event $e) => [
                'id' => $e->id,
                'title' => $e->title,
                'description' => $e->description,
                'location' => $e->location,
                'category' => $e->category,
                'starts_at' => optional($e->start_date)->toIso8601String(),
                'ends_at' => optional($e->end_date)->toIso8601String(),
                'image_url' => $this->url($e->image),
            ])->all(),
            'meta' => $this->meta($page),
        ]);
    }

    /** GET /sermons?category=<series>&page= */
    public function sermons(Request $request): JsonResponse
    {
        $query = Sermon::query();
        if ($request->filled('category')) {
            $query->where('series', $request->string('category'));
        }
        $page = $query->orderByDesc('sermon_date')->orderByDesc('id')->paginate(20);

        return response()->json([
            'categories' => Sermon::whereNotNull('series')->where('series', '!=', '')->distinct()->orderBy('series')->pluck('series'),
            'sermons' => collect($page->items())->map(fn (Sermon $s) => [
                'id' => $s->id,
                'title' => $s->title,
                'preacher' => $s->preacher,
                'scripture_reference' => $s->scripture_reference,
                'description' => $s->description,
                'series' => $s->series,
                'date' => optional($s->sermon_date)->toDateString(),
                'audio_url' => $s->audio_url ?: null,
                'video_url' => $s->video_url ?: null,
                'thumbnail_url' => $this->url($s->thumbnail),
            ])->all(),
            'meta' => $this->meta($page),
        ]);
    }

    /** GET /announcements: the ones live on the website right now, pinned first. */
    public function announcements(): JsonResponse
    {
        return response()->json([
            'announcements' => Announcement::active()->limit(50)->get()->map(fn (Announcement $a) => [
                'id' => $a->id,
                'title' => $a->title,
                'message' => $a->message,
                'type' => $a->type,
                'pinned' => (bool) $a->pinned,
                'link_url' => $a->link_url,
                'link_text' => $a->link_text,
                'date' => optional($a->starts_at ?? $a->created_at)->toDateString(),
            ])->all(),
        ]);
    }

    private function meta($page): array
    {
        return ['current_page' => $page->currentPage(), 'last_page' => $page->lastPage(), 'total' => $page->total()];
    }

    private function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        return preg_match('#^https?://#', $path) ? $path : asset('storage/' . $path);
    }
}
