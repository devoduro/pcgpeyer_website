@extends('dashboard.layouts.app')

@section('title', 'Upload Image')
@section('page-title', 'Upload to Gallery')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('dashboard.media.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <div class="mb-6">
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-4">
                <i class="fas fa-image text-yellow-600 mr-2"></i> Select Image
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-yellow-500 transition" onclick="document.getElementById('image').click();">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600 font-medium">Click to upload or drag and drop</p>
                <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 5MB</p>
                <input type="file" id="image" name="image" accept="image/*" required class="hidden" onchange="showPreview(this)">
            </div>
            <div id="preview" class="mt-4 hidden">
                <img id="previewImg" src="" alt="Preview" class="max-h-64 mx-auto rounded-lg">
            </div>
            @error('image')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Image Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                <input type="text" id="category" name="category" value="{{ old('category', 'general') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500" placeholder="e.g., Sunday Service, Events, Worship">
                @error('category')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="display_order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                <input type="number" id="display_order" name="display_order" value="{{ old('display_order', 0) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
            </div>
        </div>

        <div>
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 text-yellow-600">
                <span class="ml-2 text-sm text-gray-700">Feature this image on homepage</span>
            </label>
        </div>

        <div class="flex gap-4 mt-8">
            <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition">
                <i class="fas fa-upload mr-2"></i> Upload Image
            </button>
            <a href="{{ route('dashboard.media.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
function showPreview(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
