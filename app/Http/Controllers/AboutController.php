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
        // All active leadership members whose role is a "minister" role
        $ministers = Leadership::where('active', true)
            ->with(['titleRelation', 'yearRelation'])
            ->get()
            ->filter(fn ($leader) => str_contains(strtolower($leader->displayTitle ?? ''), 'minister'))
            ->sortByDesc('year');

        $currentMinister = $ministers->firstWhere('is_current', true);

        $pastMinisters = $ministers->reject(fn ($m) => $currentMinister && $m->id === $currentMinister->id)
            ->sortByDesc('year');

        // Category tabs are derived from the distinct minister titles actually in the database
        $categories = $pastMinisters->pluck('displayTitle')->unique()->values();
        $activeCategory = $request->get('category');

        $filteredMinisters = $activeCategory
            ? $pastMinisters->filter(fn ($m) => $m->displayTitle === $activeCategory)
            : $pastMinisters;

        $stats = [
            'earliest_year' => $ministers->count() ? $ministers->min('year') : null,
            'years_of_history' => $ministers->count() ? (now()->year - $ministers->min('year')) : 0,
            'total_ministers' => $ministers->count(),
            'ministers_in_charge' => $ministers->filter(fn ($m) => !str_contains(strtolower($m->displayTitle ?? ''), 'associate'))->count(),
            'associate_ministers' => $ministers->filter(fn ($m) => str_contains(strtolower($m->displayTitle ?? ''), 'associate'))->count(),
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
