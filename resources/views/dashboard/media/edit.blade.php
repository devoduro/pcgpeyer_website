@extends('dashboard.layouts.app')

@section('title', 'Edit Image')
@section('page-title', 'Edit Gallery Image')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('dashboard.media.update', $media) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <p class="text-sm font-semibold text-gray-700 mb-4">Current Image</p>
            <img src="{{ asset('storage/' . $media->image_path) }}" alt="{{ $media->title }}" class="max-h-48 rounded-lg mb-4">
            
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Replace Image</label>
            <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Image Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $media->title) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">{{ old('description', $media->description) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                <input type="text" id="category" name="category" value="{{ old('category', $media->category) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label for="display_order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $media->display_order) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>

        <div>
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured', $media->featured) ? 'checked' : '' }} class="h-4 w-4 text-yellow-600">
                <span class="ml-2 text-sm text-gray-700">Feature this image</span>
            </label>
        </div>

        <div class="flex gap-4 mt-8">
            <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition">
                <i class="fas fa-save mr-2"></i> Update Image
            </button>
            <a href="{{ route('dashboard.media.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
