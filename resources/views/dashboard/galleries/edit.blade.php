@extends('dashboard.layouts.app')

@section('title', 'Edit Gallery')
@section('page-title', 'Edit Gallery: ' . $gallery->title)

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @method('PUT')

        <!-- Gallery Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading text-yellow-600 mr-2"></i> Gallery Title
            </label>
            <input type="text" id="title" name="title" value="{{ old('title', $gallery->title) }}" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('title') border-red-500 @enderror">
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Gallery Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-align-left text-yellow-600 mr-2"></i> Description
            </label>
            <textarea id="description" name="description" rows="4" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">{{ old('description', $gallery->description) }}</textarea>
            @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Category -->
        <div class="mb-6">
            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-folder text-yellow-600 mr-2"></i> Category
            </label>
            <select id="category" name="category" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                <option value="">Select a category</option>
                <option value="Worship Services" {{ old('category', $gallery->category) == 'Worship Services' ? 'selected' : '' }}>Worship Services</option>
                <option value="Youth Events" {{ old('category', $gallery->category) == 'Youth Events' ? 'selected' : '' }}>Youth Events</option>
                <option value="Community Outreach" {{ old('category', $gallery->category) == 'Community Outreach' ? 'selected' : '' }}>Community Outreach</option>
                <option value="Special Events" {{ old('category', $gallery->category) == 'Special Events' ? 'selected' : '' }}>Special Events</option>
                <option value="Conferences" {{ old('category', $gallery->category) == 'Conferences' ? 'selected' : '' }}>Conferences</option>
                <option value="Baptism" {{ old('category', $gallery->category) == 'Baptism' ? 'selected' : '' }}>Baptism</option>
                <option value="Communion Service" {{ old('category', $gallery->category) == 'Communion Service' ? 'selected' : '' }}>Communion Service</option>
                <option value="Weddings" {{ old('category', $gallery->category) == 'Weddings' ? 'selected' : '' }}>Weddings</option>
                <option value="Men's Service" {{ old('category', $gallery->category) == "Men's Service" ? 'selected' : '' }}>Men's Service</option>
                <option value="Women's Service" {{ old('category', $gallery->category) == "Women's Service" ? 'selected' : '' }}>Women's Service</option>
                <option value="Choir & Music" {{ old('category', $gallery->category) == 'Choir & Music' ? 'selected' : '' }}>Choir & Music</option>
                <option value="Children Ministry" {{ old('category', $gallery->category) == 'Children Ministry' ? 'selected' : '' }}>Children Ministry</option>
                <option value="Other" {{ old('category', $gallery->category) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('category')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Current Thumbnail -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-4">
                <i class="fas fa-image text-yellow-600 mr-2"></i> Current Thumbnail
            </label>
            @if($gallery->thumbnail_path)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $gallery->thumbnail_path) }}" alt="{{ $gallery->title }}" class="max-h-48 rounded-lg shadow-md">
                </div>
            @endif
            
            <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">
                Replace Thumbnail (Optional)
            </label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500"
                   onchange="showThumbnailPreview(this)">
            <div id="thumbnailPreview" class="mt-4 hidden">
                <img id="thumbnailImg" src="" alt="New Thumbnail Preview" class="max-h-48 rounded-lg shadow-md">
            </div>
            @error('thumbnail')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Current Gallery Images -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-4">
                <i class="fas fa-images text-yellow-600 mr-2"></i> Current Gallery Images ({{ $gallery->images->count() }})
            </label>
            @if($gallery->images->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    @foreach($gallery->images as $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="{{ $image->caption ?? 'Gallery image' }}" 
                                 class="w-full h-32 object-cover rounded-lg shadow-md">
                            @if($image->caption)
                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white p-1 text-xs rounded-b-lg">
                                    {{ Str::limit($image->caption, 30) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <p class="text-sm text-gray-600 italic">
                    <i class="fas fa-info-circle"></i> To manage individual images, use the gallery detail page
                </p>
            @else
                <p class="text-gray-500 italic">No images in this gallery yet</p>
            @endif
        </div>

        <!-- Featured Checkbox -->
        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured', $gallery->is_featured) ? 'checked' : '' }} class="h-4 w-4 text-yellow-600 rounded">
                <span class="ml-2 text-sm text-gray-700">
                    <i class="fas fa-star text-yellow-500 mr-1"></i> Feature this gallery on homepage
                </span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="flex gap-4 mt-8">
            <button type="submit" class="bg-yellow-600 text-white px-8 py-3 rounded-lg hover:bg-yellow-700 transition flex items-center gap-2 font-semibold">
                <i class="fas fa-save"></i> Update Gallery
            </button>
            <a href="{{ route('dashboard.galleries.show', $gallery) }}" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition font-semibold">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
function showThumbnailPreview(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('thumbnailImg').src = e.target.result;
            document.getElementById('thumbnailPreview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
