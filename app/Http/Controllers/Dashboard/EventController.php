<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display list of events
     */
    public function index()
    {
        $events = Event::latest('start_date')->paginate(15);
        return view('dashboard.events.index', compact('events'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('dashboard.events.create');
    }

    /**
     * Store new event
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'start_date' => ['required', 'date_format:Y-m-d H:i'],
            'end_date' => ['nullable', 'date_format:Y-m-d H:i', 'after:start_date'],
            'location' => ['nullable', 'string', 'max:255'],
            'organizer' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'featured' => ['boolean'],
            'published' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($validated);
        return redirect(route('dashboard.events.index'))->with('success', 'Event created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Event $event)
    {
        return view('dashboard.events.edit', compact('event'));
    }

    /**
     * Update event
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'start_date' => ['required', 'date_format:Y-m-d H:i'],
            'end_date' => ['nullable', 'date_format:Y-m-d H:i', 'after:start_date'],
            'location' => ['nullable', 'string', 'max:255'],
            'organizer' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'featured' => ['boolean'],
            'published' => ['boolean'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($validated);
        return redirect(route('dashboard.events.index'))->with('success', 'Event updated successfully.');
    }

    /**
     * Delete event
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect(route('dashboard.events.index'))->with('success', 'Event deleted successfully.');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Event $event)
    {
        $event->update(['featured' => !$event->featured]);
        return back()->with('success', 'Event status updated.');
    }
}
