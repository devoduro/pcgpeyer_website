<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Leadership;
use App\Models\LeadershipYear;
use App\Models\LeadershipTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeadershipController extends Controller
{
    /**
     * Display a listing of leadership members
     */
    public function index(Request $request)
    {
        $query = Leadership::query();

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by title
        if ($request->filled('title_id')) {
            $query->where('title_id', $request->get('title_id'));
        }

        // Filter by year
        if ($request->filled('year')) {
            $query->where('year', $request->get('year'));
        }

        // Filter by status
        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('active', true);
            } elseif ($status === 'inactive') {
                $query->where('active', false);
            } elseif ($status === 'current') {
                $query->where('is_current', true);
            }
        }

        $leadership = $query->ordered()->paginate(15)->appends($request->query());
        
        $titles = LeadershipTitle::active()->get();
        $years = LeadershipYear::active()->get();
        
        return view('dashboard.leadership.index', compact('leadership', 'titles', 'years'));
    }

    /**
     * Show the form for creating a new leadership member
     */
    public function create()
    {
        $years = LeadershipYear::active()->get();
        $titles = LeadershipTitle::active()->get();
        return view('dashboard.leadership.create', compact('years', 'titles'));
    }

    /**
     * Display the specified leadership member
     */
    public function show(Leadership $leadership)
    {
        return view('dashboard.leadership.show', compact('leadership'));
    }

    /**
     * Store a newly created leadership member in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title_id' => ['required', 'exists:leadership_titles,id'],
            'title_text' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'year' => ['required', 'integer', 'min:1900', 'max:2100'],
            'year_end' => ['nullable', 'integer', 'min:1900', 'max:2100', 'gte:year'],
            'served_from' => ['nullable', 'date'],
            'served_to' => ['nullable', 'date', 'after_or_equal:served_from'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('leadership', 'public');
            $validated['image'] = $path;
        }

        $validated['active'] = $request->has('active');
        $validated['is_current'] = $request->has('is_current');
        $validated['display_order'] = $validated['display_order'] ?? 0;
        $validated['title_text'] = $validated['title_text'] ?? '';

        Leadership::create($validated);

        return redirect()->route('dashboard.leadership.index')
            ->with('success', 'Leadership member created successfully!');
    }

    /**
     * Show the form for editing a leadership member
     */
    public function edit(Leadership $leadership)
    {
        $years = LeadershipYear::active()->get();
        $titles = LeadershipTitle::active()->get();
        return view('dashboard.leadership.edit', compact('leadership', 'years', 'titles'));
    }

    /**
     * Update the specified leadership member in storage
     */
    public function update(Request $request, Leadership $leadership)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title_id' => ['required', 'exists:leadership_titles,id'],
            'title_text' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'year' => ['required', 'integer', 'min:1900', 'max:2100'],
            'year_end' => ['nullable', 'integer', 'min:1900', 'max:2100', 'gte:year'],
            'served_from' => ['nullable', 'date'],
            'served_to' => ['nullable', 'date', 'after_or_equal:served_from'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($leadership->image) {
                Storage::disk('public')->delete($leadership->image);
            }
            $path = $request->file('image')->store('leadership', 'public');
            $validated['image'] = $path;
        }

        $validated['active'] = $request->has('active');
        $validated['is_current'] = $request->has('is_current');
        $validated['display_order'] = $validated['display_order'] ?? $leadership->display_order;
        $validated['title_text'] = $validated['title_text'] ?? '';

        $leadership->update($validated);

        return redirect()->route('dashboard.leadership.index')
            ->with('success', 'Leadership member updated successfully!');
    }

    /**
     * Delete the specified leadership member
     */
    public function destroy(Leadership $leadership)
    {
        if ($leadership->image) {
            Storage::disk('public')->delete($leadership->image);
        }

        $leadership->delete();

        return redirect()->route('dashboard.leadership.index')
            ->with('success', 'Leadership member deleted successfully!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Leadership $leadership)
    {
        $leadership->update(['active' => !$leadership->active]);

        return redirect()->route('dashboard.leadership.index')
            ->with('success', 'Leadership member status updated!');
    }

    /**
     * Show manage years page
     */
    public function manageYears()
    {
        $years = LeadershipYear::orderBy('year', 'desc')->get();
        return view('dashboard.leadership.manage-years', compact('years'));
    }

    /**
     * Store a new leadership year
     */
    public function storeYear(Request $request)
    {
        $validated = $request->validate([
            'year' => ['required', 'integer', 'min:1900', 'max:2100', 'unique:leadership_years,year'],
            'year_end' => ['nullable', 'integer', 'min:1900', 'max:2100', 'gte:year'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['active'] = true;
        LeadershipYear::create($validated);

        return redirect()->route('dashboard.leadership.manage-years')
            ->with('success', 'Leadership year range created successfully!');
    }

    /**
     * Update a leadership year
     */
    public function updateYear(Request $request, LeadershipYear $year)
    {
        $validated = $request->validate([
            'year' => ['required', 'integer', 'min:1900', 'max:2100', 'unique:leadership_years,year,' . $year->id],
            'year_end' => ['nullable', 'integer', 'min:1900', 'max:2100', 'gte:year'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $year->update($validated);

        return redirect()->route('dashboard.leadership.manage-years')
            ->with('success', 'Leadership year updated successfully!');
    }

    /**
     * Toggle a leadership year active status
     */
    public function toggleYear(LeadershipYear $year)
    {
        $year->update(['active' => !$year->active]);

        return redirect()->route('dashboard.leadership.manage-years')
            ->with('success', 'Leadership year status updated!');
    }

    /**
     * Delete a leadership year
     */
    public function deleteYear(LeadershipYear $year)
    {
        if ($year->leaders()->count() > 0) {
            return redirect()->route('dashboard.leadership.manage-years')
                ->with('error', 'Cannot delete a year with assigned leaders!');
        }

        $year->delete();

        return redirect()->route('dashboard.leadership.manage-years')
            ->with('success', 'Leadership year deleted successfully!');
    }

    /**
     * Show manage titles page
     */
    public function manageTitles()
    {
        $titles = LeadershipTitle::orderBy('title', 'asc')->get();
        return view('dashboard.leadership.manage-titles', compact('titles'));
    }

    /**
     * Store a new leadership title
     */
    public function storeTitle(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:leadership_titles,title'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['active'] = true;
        LeadershipTitle::create($validated);

        return redirect()->route('dashboard.leadership.manage-titles')
            ->with('success', 'Leadership title created successfully!');
    }

    /**
     * Update a leadership title
     */
    public function updateTitle(Request $request, LeadershipTitle $title)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:leadership_titles,title,' . $title->id],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $title->update($validated);

        return redirect()->route('dashboard.leadership.manage-titles')
            ->with('success', 'Leadership title updated successfully!');
    }

    /**
     * Toggle a leadership title active status
     */
    public function toggleTitle(LeadershipTitle $title)
    {
        $title->update(['active' => !$title->active]);

        return redirect()->route('dashboard.leadership.manage-titles')
            ->with('success', 'Leadership title status updated!');
    }

    /**
     * Delete a leadership title
     */
    public function deleteTitle(LeadershipTitle $title)
    {
        if ($title->leaders()->count() > 0) {
            return redirect()->route('dashboard.leadership.manage-titles')
                ->with('error', 'Cannot delete a title with assigned leaders!');
        }

        $title->delete();

        return redirect()->route('dashboard.leadership.manage-titles')
            ->with('success', 'Leadership title deleted successfully!');
    }
}
