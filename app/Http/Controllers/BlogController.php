<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Get published blog posts from database
        $posts = BlogPost::where('published', true)
            ->latest('published_at')
            ->paginate(12);
        
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        // Get single blog post by slug
        $post = BlogPost::where('slug', $slug)
            ->where('published', true)
            ->firstOrFail();
        
        // Get related posts
        $relatedPosts = BlogPost::where('published', true)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        
        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
