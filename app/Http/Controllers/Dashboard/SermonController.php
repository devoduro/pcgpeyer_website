<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SermonController extends Controller
{
    /**
     * Display list of sermons
     */
    public function index()
    {
        $sermons = Sermon::latest('sermon_date')->paginate(15);
        return view('dashboard.sermons.index', compact('sermons'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('dashboard.sermons.create');
    }

    /**
     * Store new sermon
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'preacher' => ['required', 'string', 'max:255'],
            'sermon_date' => ['required', 'date'],
            'scripture_reference' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'audio_url' => ['nullable', 'url'],
            'video_url' => ['nullable', 'url'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'series' => ['nullable', 'string', 'max:255'],
            'featured' => ['boolean'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('sermons', 'public');
        }

        Sermon::create($validated);
        return redirect(route('dashboard.sermons.index'))->with('success', 'Sermon added successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Sermon $sermon)
    {
        return view('dashboard.sermons.edit', compact('sermon'));
    }

    /**
     * Update sermon
     */
    public function update(Request $request, Sermon $sermon)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'preacher' => ['required', 'string', 'max:255'],
            'sermon_date' => ['required', 'date'],
            'scripture_reference' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'audio_url' => ['nullable', 'url'],
            'video_url' => ['nullable', 'url'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'series' => ['nullable', 'string', 'max:255'],
            'featured' => ['boolean'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('sermons', 'public');
        }

        $sermon->update($validated);
        return redirect(route('dashboard.sermons.index'))->with('success', 'Sermon updated successfully.');
    }

    /**
     * Delete sermon
     */
    public function destroy(Sermon $sermon)
    {
        $sermon->delete();
        return redirect(route('dashboard.sermons.index'))->with('success', 'Sermon deleted successfully.');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Sermon $sermon)
    {
        $sermon->update(['featured' => !$sermon->featured]);
        return back()->with('success', 'Sermon status updated.');
    }
}
