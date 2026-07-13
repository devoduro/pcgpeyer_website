<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    /**
     * Display list of blog posts
     */
    public function index()
    {
        $posts = BlogPost::latest('published_at')->paginate(15);
        return view('dashboard.blog.index', compact('posts'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('dashboard.blog.create');
    }

    /**
     * Store new blog post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        if (!isset($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);
        return redirect(route('dashboard.blog.index'))->with('success', 'Blog post created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(BlogPost $blog)
    {
        return view('dashboard.blog.edit', compact('blog'));
    }

    /**
     * Update blog post
     */
    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'author' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog', 'public');
        }

        $blog->update($validated);
        return redirect(route('dashboard.blog.index'))->with('success', 'Blog post updated successfully.');
    }

    /**
     * Delete blog post
     */
    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect(route('dashboard.blog.index'))->with('success', 'Blog post deleted successfully.');
    }

    /**
     * Toggle publish status
     */
    public function togglePublish(BlogPost $blog)
    {
        $blog->update(['published' => !$blog->published]);
        return back()->with('success', 'Post status updated.');
    }
}
