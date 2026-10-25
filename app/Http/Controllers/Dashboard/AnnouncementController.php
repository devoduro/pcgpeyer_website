<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display list of announcements
     */
    public function index()
    {
        $announcements = Announcement::orderByDesc('pinned')
            ->orderBy('display_order')
            ->latest()
            ->paginate(15);

        return view('dashboard.announcements.index', compact('announcements'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('dashboard.announcements.create');
    }

    /**
     * Store new announcement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'type' => ['required', 'in:info,urgent,event'],
            'link_url' => ['nullable', 'url', 'max:255'],
            'link_text' => ['nullable', 'string', 'max:100'],
            'starts_at' => ['nullable', 'date_format:Y-m-d\TH:i'],
            'expires_at' => ['nullable', 'date_format:Y-m-d\TH:i', 'after:starts_at'],
            'pinned' => ['boolean'],
            'published' => ['boolean'],
            'display_order' => ['nullable', 'integer'],
        ]);

        $validated['pinned'] = $request->boolean('pinned');
        $validated['published'] = $request->boolean('published', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        Announcement::create($validated);

        return redirect(route('dashboard.announcements.index'))->with('success', 'Announcement created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Announcement $announcement)
    {
        return view('dashboard.announcements.edit', compact('announcement'));
    }

    /**
     * Update announcement
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'type' => ['required', 'in:info,urgent,event'],
            'link_url' => ['nullable', 'url', 'max:255'],
            'link_text' => ['nullable', 'string', 'max:100'],
            'starts_at' => ['nullable', 'date_format:Y-m-d\TH:i'],
            'expires_at' => ['nullable', 'date_format:Y-m-d\TH:i', 'after:starts_at'],
            'pinned' => ['boolean'],
            'published' => ['boolean'],
            'display_order' => ['nullable', 'integer'],
        ]);

        $validated['pinned'] = $request->boolean('pinned');
        $validated['published'] = $request->boolean('published');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        $announcement->update($validated);

        return redirect(route('dashboard.announcements.index'))->with('success', 'Announcement updated successfully.');
    }

    /**
     * Delete announcement
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect(route('dashboard.announcements.index'))->with('success', 'Announcement deleted successfully.');
    }

    /**
     * Toggle published status
     */
    public function togglePublish(Announcement $announcement)
    {
        $announcement->update(['published' => !$announcement->published]);
        return back()->with('success', 'Announcement status updated.');
    }
}
