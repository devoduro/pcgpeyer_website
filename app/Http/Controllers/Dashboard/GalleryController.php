<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('dashboard.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'nullable|string|max:255',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images' => 'required|array|min:1',
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'captions.*' => 'nullable|string|max:255',
            ]);

            // Check if thumbnail exists in the request
            if (!$request->hasFile('thumbnail')) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['thumbnail' => 'The thumbnail image is required.']);
            }

            // Check if images exist in the request
            if (!$request->hasFile('images')) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['images' => 'At least one gallery image is required.']);
            }

            // Store thumbnail
            $thumbnailPath = $request->file('thumbnail')->store('galleries/thumbnails', 'public');

            // Create gallery record
            $gallery = Gallery::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'category' => $validated['category'] ?? null,
                'thumbnail_path' => $thumbnailPath,
                'is_featured' => $request->has('is_featured'),
                'created_by' => auth()->id(),
            ]);

            // Handle gallery images
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('galleries/images', 'public');
                
                GalleryImage::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $path,
                    'caption' => $request->captions[$index] ?? null,
                    'display_order' => $index,
                ]);
            }

            return redirect()->route('dashboard.galleries.index')
                ->with('success', 'Gallery created successfully.');
                
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Gallery creation failed: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create gallery. ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery->load(['creator', 'images']);
        return view('dashboard.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $gallery->load('images');
        return view('dashboard.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'sometimes|boolean',
        ]);

        // Update thumbnail if provided
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($gallery->thumbnail_path) {
                Storage::disk('public')->delete($gallery->thumbnail_path);
            }
            
            // Store new thumbnail
            $thumbnailPath = $request->file('thumbnail')->store('galleries/thumbnails', 'public');
            $gallery->thumbnail_path = $thumbnailPath;
        }

        $gallery->title = $validated['title'];
        $gallery->description = $validated['description'];
        $gallery->category = $validated['category'];
        $gallery->is_featured = $request->has('featured');
        $gallery->save();

        return redirect()->route('dashboard.galleries.index')
            ->with('success', 'Gallery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete thumbnail
        if ($gallery->thumbnail_path) {
            Storage::disk('public')->delete($gallery->thumbnail_path);
        }
        
        // Delete all gallery images
        foreach ($gallery->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $gallery->delete();

        return redirect()->route('dashboard.galleries.index')
            ->with('success', 'Gallery deleted successfully.');
    }
    
    /**
     * Toggle featured status
     */
    public function toggleFeatured(Gallery $gallery)
    {
        $gallery->is_featured = !$gallery->is_featured;
        $gallery->save();
        
        return redirect()->back()->with('success', 'Gallery featured status updated.');
    }
    
    /**
     * Store a new image for the gallery
     */
    public function storeImage(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);
        
        $path = $request->file('image')->store('galleries/images', 'public');
        
        // Get the highest display order
        $maxOrder = $gallery->images()->max('display_order') ?? -1;
        
        GalleryImage::create([
            'gallery_id' => $gallery->id,
            'image_path' => $path,
            'caption' => $validated['caption'],
            'display_order' => $maxOrder + 1,
        ]);
        
        return redirect()->back()->with('success', 'Image added to gallery.');
    }
    
    /**
     * Remove an image from the gallery
     */
    public function destroyImage(Gallery $gallery, GalleryImage $image)
    {
        // Check if image belongs to this gallery
        if ($image->gallery_id !== $gallery->id) {
            return redirect()->back()->with('error', 'Image does not belong to this gallery.');
        }
        
        // Delete the image file
        Storage::disk('public')->delete($image->image_path);
        
        // Delete the image record
        $image->delete();
        
        return redirect()->back()->with('success', 'Image removed from gallery.');
    }
}
