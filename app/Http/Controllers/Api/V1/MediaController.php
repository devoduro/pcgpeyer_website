<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Website media for the mobile app. Mirrors /media/videos and /media/photos: the same
 * published-only rule, ordering and category filter.
 */
class MediaController extends Controller
{
    /** GET /media/videos?category=&page= */
    public function videos(Request $request): JsonResponse
    {
        $query = Video::published();
        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        $page = $query->orderByDesc('featured')->orderByDesc('created_at')->paginate(20);

        return response()->json([
            'categories' => Video::published()->whereNotNull('category')->distinct()->orderBy('category')->pluck('category'),
            'videos' => collect($page->items())->map(fn (Video $v) => [
                'id' => $v->id,
                'title' => $v->title,
                'description' => $v->description,
                'category' => $v->category,
                'type' => $v->video_type,
                'youtube_id' => $v->youtube_id,
                // Where the app sends the viewer: the YouTube/Vimeo page, or the uploaded file.
                'watch_url' => $v->video_type === 'upload' ? $v->embed_url : $v->video_url,
                'thumbnail_url' => $v->thumbnail_url,
                'duration' => $v->duration,
                'featured' => (bool) $v->featured,
                'date' => optional($v->publish_date ?? $v->created_at)->toDateString(),
            ])->all(),
            'meta' => $this->meta($page),
        ]);
    }

    /** GET /media/photos?category=&page=: albums with a cover and photo count. */
    public function photos(Request $request): JsonResponse
    {
        $query = Gallery::withCount('images');
        if ($request->filled('category')) {
            $query->where('category', $request->string('category'));
        }

        $page = $query->orderByDesc('is_featured')->orderByDesc('created_at')->paginate(20);

        return response()->json([
            'categories' => Gallery::whereNotNull('category')->distinct()->orderBy('category')->pluck('category'),
            'albums' => collect($page->items())->map(fn (Gallery $g) => $this->album($g))->all(),
            'meta' => $this->meta($page),
        ]);
    }

    /** GET /media/photos/{gallery}: one album with all its photos. */
    public function show(Gallery $gallery): JsonResponse
    {
        $gallery->loadCount('images')->load('images');

        return response()->json([
            'album' => $this->album($gallery) + [
                'photos' => $gallery->images->map(fn (GalleryImage $i) => [
                    'id' => $i->id,
                    'url' => $this->url($i->image_path),
                    'caption' => $i->caption,
                ])->all(),
            ],
        ]);
    }

    private function album(Gallery $g): array
    {
        return [
            'id' => $g->id,
            'title' => $g->title,
            'description' => $g->description,
            'category' => $g->category,
            'featured' => (bool) $g->is_featured,
            // The album thumbnail, or its first photo when none was uploaded.
            'cover_url' => $this->url($g->thumbnail_path ?: optional($g->images()->first())->image_path),
            'photo_count' => (int) $g->images_count,
            'date' => optional($g->created_at)->toDateString(),
        ];
    }

    private function meta($page): array
    {
        return ['current_page' => $page->currentPage(), 'last_page' => $page->lastPage(), 'total' => $page->total()];
    }

    private function url(?string $path): ?string
    {
        return $path ? asset('storage/' . $path) : null;
    }
}
