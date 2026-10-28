<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Leadership;
use App\Models\Ministry;
use Illuminate\Http\JsonResponse;

/**
 * Church leadership for the mobile app. Mirrors the public website pages and exposes only the
 * fields those pages already show: /about/leadership, /about/ministers and /group-leadership.
 */
class LeadershipController extends Controller
{
    /** GET /leadership: leaders grouped by service period, the current period first. */
    public function index(): JsonResponse
    {
        $leaders = Leadership::where('active', true)->termRoster()->with(['titleRelation', 'yearRelation'])
            ->orderBy('display_order')->orderBy('name')->get();

        $periods = $leaders
            ->groupBy(fn ($l) => $l->yearRange)
            ->map(fn ($group, $period) => [
                'period' => (string) $period,
                'start_year' => (int) $group->first()->year,
                'is_current' => $group->contains(fn ($l) => $l->is_current),
                'leaders' => $group->values()->map(fn ($l) => $this->leader($l))->all(),
            ])
            // Current period first, then newest to oldest.
            ->sortBy(fn ($p) => [$p['is_current'] ? 0 : 1, -$p['start_year']])
            ->values();

        return response()->json([
            'current_period' => optional($periods->firstWhere('is_current', true))['period'],
            'periods' => $periods,
        ]);
    }

    /** GET /leadership/past: everyone not currently serving, with the Past ministers categories. */
    public function past(): JsonResponse
    {
        $all = Leadership::where('active', true)->with(['titleRelation', 'yearRelation'])
            ->orderByDesc('year')->orderBy('display_order')->orderBy('name')->get();

        $currentMinister = $all->first(fn ($l) => $l->is_current
            && Leadership::ministerCategory($l->displayTitle) === 'Ministers-in-Charge');

        $past = $all->reject(fn ($l) => $l->is_current)->values();

        return response()->json([
            'categories' => Leadership::MINISTER_CATEGORIES,
            'current_minister' => $currentMinister ? $this->leader($currentMinister) : null,
            'leaders' => $past->map(fn ($l) => $this->leader($l) + [
                'category' => Leadership::ministerCategory($l->displayTitle),
                'service_duration' => $l->serviceDuration,
            ])->all(),
        ]);
    }

    /** GET /group-leadership: ministries and groups that have a leader. */
    public function groups(): JsonResponse
    {
        $groups = Ministry::active()->whereNotNull('leader')->orderBy('name')->get();

        return response()->json([
            'groups' => $groups->map(fn ($m) => [
                'id' => $m->id,
                'name' => $m->name,
                'category' => $m->ministry_category,
                'type' => $m->category,
                'age_range' => $m->age_range,
                'leader' => $m->leader,
                'leader_phone' => $m->leader_phone,
                'contact_email' => $m->contact_email,
                'leader_picture_url' => $this->url($m->leader_picture),
                'image_url' => $this->url($m->image),
                'meeting_schedule' => $m->meeting_schedule,
                'location' => $m->location,
                'about' => $m->content ?: $m->description,
            ])->all(),
        ]);
    }

    private function leader(Leadership $l): array
    {
        return [
            'id' => $l->id,
            'name' => $l->name,
            'title' => $l->displayTitle,
            'period' => $l->yearRange,
            'is_current' => (bool) $l->is_current,
            'bio' => $l->bio,
            'email' => $l->email,
            'phone' => $l->phone,
            'image_url' => $this->url($l->image),
        ];
    }

    private function url(?string $path): ?string
    {
        return $path ? asset('storage/' . $path) : null;
    }
}
