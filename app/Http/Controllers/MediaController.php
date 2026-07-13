<?php

namespace App\Http\Controllers;

use App\Models\MediaGallery;
use App\Models\Gallery;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function photos(Request $request)
    {
        // Get all unique categories
        $categories = Gallery::whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();
        
        // Build query
        $query = Gallery::with('images');
        
        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
        
        // Get galleries with their images
        $galleries = $query->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('media.photos', compact('galleries', 'categories'));
    }

    public function videos(Request $request)
    {
        // Get all unique categories
        $categories = \App\Models\Video::whereNotNull('category')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();
        
        // Build query
        $query = \App\Models\Video::published();
        
        // Filter by category if provided
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
        
        // Get videos
        $videos = $query->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('media.videos', compact('videos', 'categories'));
    }
    
    public function index()
    {
        // Get all media
        $media = MediaGallery::orderBy('featured', 'desc')
            ->orderBy('event_date', 'desc')
            ->orderBy('order')
            ->paginate(24);
            
        $categories = MediaGallery::distinct('category')
            ->pluck('category')
            ->filter();
            
        return view('media.index', compact('media', 'categories'));
    }
}
