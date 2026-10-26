<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ministry;
use App\Models\Leadership;

class AboutController extends Controller
{
    public function history()
    {
        return view('about.history');
    }

    public function staff()
    {
        return view('about.staff');
    }

    public function leadership(Request $request)
    {
        // Get filter year from request (this is the numeric year value, not the range)
        $filterYear = $request->get('year');
        
        // Get all active leadership members with their year relationships
        $query = Leadership::where('active', true)->with('yearRelation');
        
        // Apply year filter if provided
        if ($filterYear) {
            $query->where('year', $filterYear);
        }
        
        // Get all leadership data first
        $allLeadership = $query->get();
        
        // Get leadership members grouped by year range, then sort by year (descending)
        $leadershipByYear = $allLeadership
            ->groupBy(function ($item) {
                return $item->yearRelation?->yearRange ?? (string) $item->year;
            });
        
        // Sort the keys (year ranges) in descending order
        $leadershipByYear = $leadershipByYear->sortBy(function ($group, $key) {
            $yearA = (int) (str_contains($key, '-') ? explode('-', $key)[0] : $key);
            return -$yearA; // Descending
        });
        
        // Get all unique years and their ranges for the filter dropdown
        $yearMappings = Leadership::where('active', true)
            ->select('year')
            ->distinct()
            ->get()
            ->map(function ($item) {
                $yearRelation = \App\Models\LeadershipYear::where('year', $item->year)->first();
                return [
                    'year' => $item->year,
                    'range' => $yearRelation?->yearRange ?? (string) $item->year
                ];
            })
            ->sortBy(function ($item) {
                $yearA = (int) (str_contains($item['range'], '-') ? explode('-', $item['range'])[0] : $item['range']);
                return -$yearA; // Descending
            })
            ->values();
        
        $availableYears = $yearMappings->pluck('range');
        
        // Get the year of any leadership marked as current
        $currentLeadership = Leadership::where('active', true)->where('is_current', true)->first();
        $currentYear = $currentLeadership ? ($currentLeadership->yearRelation?->yearRange ?? (string) $currentLeadership->year) : null;
        
        return view('about.leadership', compact('leadershipByYear', 'currentYear', 'availableYears', 'filterYear', 'yearMappings'));
    }

    public function ministers(Request $request)
    {
        // Fixed categories shown as tabs (shared with the mobile app API via the model)
        $categories = Leadership::MINISTER_CATEGORIES;

        $allLeaders = Leadership::where('active', true)
            ->with(['titleRelation', 'yearRelation'])
            ->get()
            ->sortByDesc('year');

        $bucketOf = fn ($leader) => Leadership::ministerCategory($leader->displayTitle);

        // Current minister-in-charge, shown in the "Current Leadership" callout
        $currentMinister = $allLeaders->first(fn ($l) => $l->is_current && $bucketOf($l) === 'Ministers-in-Charge');

        // Past leaders = anyone not marked as currently serving
        $pastMinisters = $allLeaders->reject(fn ($l) => $l->is_current)->sortByDesc('year');

        $activeCategory = $request->get('category');

        $filteredMinisters = $activeCategory
            ? $pastMinisters->filter(fn ($m) => $bucketOf($m) === $activeCategory)
            : $pastMinisters;

        $stats = [
            'earliest_year' => $pastMinisters->count() ? $pastMinisters->min('year') : null,
            'years_of_history' => $pastMinisters->count() ? (now()->year - $pastMinisters->min('year')) : 0,
            'ministers_in_charge' => $pastMinisters->filter(fn ($m) => $bucketOf($m) === 'Ministers-in-Charge')->count(),
            'catechists' => $pastMinisters->filter(fn ($m) => $bucketOf($m) === 'Catechists')->count(),
            'session_terms' => $pastMinisters->pluck('year')->unique()->count(),
        ];

        return view('about.ministers', compact(
            'currentMinister',
            'pastMinisters',
            'filteredMinisters',
            'categories',
            'activeCategory',
            'stats'
        ));
    }
}
