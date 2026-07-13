<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ministry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MinistryController extends Controller
{
    /**
     * Display list of ministries
     */
    public function index()
    {
        $ministries = Ministry::latest('created_at')->paginate(15);
        return view('dashboard.ministries.index', compact('ministries'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('dashboard.ministries.create');
    }

    /**
     * Store new ministry
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'in:inter-generational,generational'],
            'ministry_category' => ['nullable', 'string', 'max:255'],
            'age_range' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'leader' => ['nullable', 'string', 'max:255'],
            'leader_phone' => ['nullable', 'string', 'max:255'],
            'leader_picture' => ['nullable', 'image', 'max:2048'],
            'contact_email' => ['nullable', 'email'],
            'meeting_schedule' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'featured' => ['boolean'],
            'active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('ministries', 'public');
        }

        if ($request->hasFile('leader_picture')) {
            $validated['leader_picture'] = $request->file('leader_picture')->store('ministry-leaders', 'public');
        }

        Ministry::create($validated);
        return redirect(route('dashboard.ministries.index'))->with('success', 'Ministry created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Ministry $ministry)
    {
        return view('dashboard.ministries.edit', compact('ministry'));
    }

    /**
     * Update ministry
     */
    public function update(Request $request, Ministry $ministry)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'in:inter-generational,generational'],
            'ministry_category' => ['nullable', 'string', 'max:255'],
            'age_range' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'leader' => ['nullable', 'string', 'max:255'],
            'leader_phone' => ['nullable', 'string', 'max:255'],
            'leader_picture' => ['nullable', 'image', 'max:2048'],
            'contact_email' => ['nullable', 'email'],
            'meeting_schedule' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'featured' => ['boolean'],
            'active' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('ministries', 'public');
        }

        if ($request->hasFile('leader_picture')) {
            $validated['leader_picture'] = $request->file('leader_picture')->store('ministry-leaders', 'public');
        }

        $ministry->update($validated);
        return redirect(route('dashboard.ministries.index'))->with('success', 'Ministry updated successfully.');
    }

    /**
     * Delete ministry
     */
    public function destroy(Ministry $ministry)
    {
        $ministry->delete();
        return redirect(route('dashboard.ministries.index'))->with('success', 'Ministry deleted successfully.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Ministry $ministry)
    {
        $ministry->update(['active' => !$ministry->active]);
        return back()->with('success', 'Ministry status updated.');
    }
}
