<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Video::query();
        
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        $videos = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Video::distinct()->pluck('category')->filter()->sort()->values();
        
        return view('dashboard.video.index', compact('videos', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_type' => 'required|in:youtube,vimeo,upload',
            'video_url' => 'required_if:video_type,youtube,vimeo|nullable|url',
            'video_file' => 'required_if:video_type,upload|nullable|file|mimes:mp4,mov,avi,wmv|max:102400',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:20',
            'featured' => 'boolean',
            'published' => 'boolean',
            'publish_date' => 'nullable|date',
        ]);
        
        // Handle video file upload
        if ($request->hasFile('video_file')) {
            $validated['video_file'] = $request->file('video_file')->store('videos', 'public');
        }
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }
        
        $validated['featured'] = $request->has('featured');
        $validated['published'] = $request->has('published');
        
        Video::create($validated);
        
        return redirect()->route('dashboard.videos.index')
            ->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('dashboard.video.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('dashboard.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_type' => 'required|in:youtube,vimeo,upload',
            'video_url' => 'required_if:video_type,youtube,vimeo|nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:20',
            'featured' => 'boolean',
            'published' => 'boolean',
            'publish_date' => 'nullable|date',
        ]);
        
        // Handle video file upload
        if ($request->hasFile('video_file')) {
            // Delete old file
            if ($video->video_file) {
                Storage::disk('public')->delete($video->video_file);
            }
            $validated['video_file'] = $request->file('video_file')->store('videos', 'public');
        }
        
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }
        
        $validated['featured'] = $request->has('featured');
        $validated['published'] = $request->has('published');
        
        $video->update($validated);
        
        return redirect()->route('dashboard.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        // Delete video file if exists
        if ($video->video_file) {
            Storage::disk('public')->delete($video->video_file);
        }
        
        // Delete thumbnail if exists
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        
        $video->delete();
        
        return redirect()->route('dashboard.videos.index')
            ->with('success', 'Video deleted successfully.');
    }
    
    /**
     * Toggle featured status
     */
    public function toggleFeatured(Video $video)
    {
        $video->update(['featured' => !$video->featured]);
        
        return back()->with('success', 'Video featured status updated.');
    }
    
    /**
     * Toggle published status
     */
    public function togglePublished(Video $video)
    {
        $video->update(['published' => !$video->published]);
        
        return back()->with('success', 'Video published status updated.');
    }
}
