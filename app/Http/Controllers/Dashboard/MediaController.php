<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MediaGallery;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display gallery list
     */
    public function index()
    {
        $items = MediaGallery::latest('created_at')->paginate(20);
        $categories = MediaGallery::distinct('category')->pluck('category');
        return view('dashboard.media.index', compact('items', 'categories'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('dashboard.media.create');
    }

    /**
     * Store new gallery item
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'max:5120'],
            'category' => ['required', 'string', 'max:255'],
            'featured' => ['boolean'],
            'display_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $validated['uploaded_by'] = auth()->user()->name;

        MediaGallery::create($validated);
        return redirect(route('dashboard.media.index'))->with('success', 'Image uploaded successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(MediaGallery $media)
    {
        return view('dashboard.media.edit', compact('media'));
    }

    /**
     * Update gallery item
     */
    public function update(Request $request, MediaGallery $media)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'category' => ['required', 'string', 'max:255'],
            'featured' => ['boolean'],
            'display_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $media->update($validated);
        return redirect(route('dashboard.media.index'))->with('success', 'Image updated successfully.');
    }

    /**
     * Delete gallery item
     */
    public function destroy(MediaGallery $media)
    {
        $media->delete();
        return redirect(route('dashboard.media.index'))->with('success', 'Image deleted successfully.');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(MediaGallery $media)
    {
        $media->update(['featured' => !$media->featured]);
        return back()->with('success', 'Gallery item status updated.');
    }
}
