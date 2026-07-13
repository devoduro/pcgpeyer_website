@extends('dashboard.layouts.app')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post: ' . $blog->title)

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.blog.update', $blog) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading text-blue-600 mr-2"></i> Post Title
            </label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title', $blog->title) }}"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                placeholder="Enter post title"
            >
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Excerpt -->
        <div class="mb-6">
            <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-quote-left text-blue-600 mr-2"></i> Excerpt
            </label>
            <textarea 
                id="excerpt" 
                name="excerpt" 
                rows="3"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('excerpt') border-red-500 @enderror"
                placeholder="Brief summary of the post"
            >{{ old('excerpt', $blog->excerpt) }}</textarea>
            @error('excerpt')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Content -->
        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-file-alt text-blue-600 mr-2"></i> Content
            </label>
            <textarea 
                id="content" 
                name="content" 
                rows="10"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                placeholder="Full post content"
            >{{ old('content', $blog->content) }}</textarea>
            @error('content')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <!-- Author -->
            <div>
                <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-user text-blue-600 mr-2"></i> Author
                </label>
                <input 
                    type="text" 
                    id="author" 
                    name="author" 
                    value="{{ old('author', $blog->author) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('author') border-red-500 @enderror"
                    placeholder="Author name"
                >
                @error('author')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-image text-blue-600 mr-2"></i> Featured Image
                </label>
                <input 
                    type="file" 
                    id="image" 
                    name="image" 
                    accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror"
                >
                @if($blog->image)
                <p class="text-xs text-gray-600 mt-2">Current image: {{ basename($blog->image) }}</p>
                @endif
                @error('image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Publish Settings -->
        <div class="bg-gray-50 p-6 rounded-lg mb-6 border border-gray-200">
            <h4 class="font-semibold text-gray-900 mb-4">Publish Settings</h4>
            
            <div class="flex items-center mb-4">
                <input 
                    type="checkbox" 
                    id="published" 
                    name="published" 
                    value="1"
                    {{ old('published', $blog->published) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 rounded"
                >
                <label for="published" class="ml-3 text-sm text-gray-700">
                    Publish this post
                </label>
            </div>

            <div>
                <label for="published_at" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-calendar text-blue-600 mr-2"></i> Publish Date
                </label>
                <input 
                    type="date" 
                    id="published_at" 
                    name="published_at" 
                    value="{{ old('published_at', $blog->published_at?->format('Y-m-d')) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fas fa-save"></i> Update Post
            </button>
            <a href="{{ route('dashboard.blog.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
