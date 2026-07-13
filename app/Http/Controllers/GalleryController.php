<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries.
     */
    public function index()
    {
        $galleries = Gallery::with('images')
            ->latest()
            ->paginate(12);
            
        return view('pages.gallery.index', compact('galleries'));
    }

    /**
     * Display the specified gallery.
     */
    public function show($id)
    {
        $gallery = Gallery::with('images', 'creator')
            ->findOrFail($id);
            
        return view('pages.gallery.show', compact('gallery'));
    }
}
