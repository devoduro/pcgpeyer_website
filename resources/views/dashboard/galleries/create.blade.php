@extends('dashboard.layouts.app')

@section('title', 'Create Gallery')
@section('page-title', 'Create New Photo Gallery')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.galleries.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <!-- Gallery Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading text-yellow-600 mr-2"></i> Gallery Title
            </label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('title') border-red-500 @enderror"
                   placeholder="e.g., Easter Sunday 2025, Youth Camp Photos">
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Gallery Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-align-left text-yellow-600 mr-2"></i> Description
            </label>
            <textarea id="description" name="description" rows="4" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                      placeholder="Brief description of this gallery...">{{ old('description') }}</textarea>
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
                <option value="Worship Services" {{ old('category') == 'Worship Services' ? 'selected' : '' }}>Worship Services</option>
                <option value="Youth Events" {{ old('category') == 'Youth Events' ? 'selected' : '' }}>Youth Events</option>
                <option value="Community Outreach" {{ old('category') == 'Community Outreach' ? 'selected' : '' }}>Community Outreach</option>
                <option value="Special Events" {{ old('category') == 'Special Events' ? 'selected' : '' }}>Special Events</option>
                <option value="Conferences" {{ old('category') == 'Conferences' ? 'selected' : '' }}>Conferences</option>
                <option value="Baptism" {{ old('category') == 'Baptism' ? 'selected' : '' }}>Baptism</option>
                <option value="Communion Service" {{ old('category') == 'Communion Service' ? 'selected' : '' }}>Communion Service</option>
                <option value="Weddings" {{ old('category') == 'Weddings' ? 'selected' : '' }}>Weddings</option>
                <option value="Men's Service" {{ old('category') == "Men's Service" ? 'selected' : '' }}>Men's Service</option>
                <option value="Women's Service" {{ old('category') == "Women's Service" ? 'selected' : '' }}>Women's Service</option>
                <option value="Choir & Music" {{ old('category') == 'Choir & Music' ? 'selected' : '' }}>Choir & Music</option>
                <option value="Children Ministry" {{ old('category') == 'Children Ministry' ? 'selected' : '' }}>Children Ministry</option>
                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('category')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Thumbnail Upload -->
        <div class="mb-6">
            <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-4">
                <i class="fas fa-image text-yellow-600 mr-2"></i> Gallery Thumbnail (Cover Photo)
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-yellow-500 transition" onclick="document.getElementById('thumbnail').click();">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600 font-medium">Click to upload thumbnail</p>
                <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 2MB</p>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required class="hidden" onchange="showThumbnailPreview(this)">
            </div>
            <div id="thumbnailPreview" class="mt-4 hidden">
                <img id="thumbnailImg" src="" alt="Thumbnail Preview" class="max-h-48 mx-auto rounded-lg shadow-md">
            </div>
            @error('thumbnail')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Gallery Images Upload -->
        <div class="mb-6">
            <label for="images" class="block text-sm font-semibold text-gray-700 mb-4">
                <i class="fas fa-images text-yellow-600 mr-2"></i> Gallery Images (Multiple)
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-yellow-500 transition" onclick="document.getElementById('images').click();">
                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600 font-medium">Click to upload multiple images</p>
                <p class="text-xs text-gray-500 mt-2">Select multiple PNG, JPG, GIF files (up to 2MB each)</p>
                <input type="file" id="images" name="images[]" accept="image/*" required multiple class="hidden" onchange="showImagesPreviews(this)">
            </div>
            <div id="imagesPreviews" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden"></div>
            @error('images')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            @error('images.*')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Image Captions -->
        <div id="captionsContainer" class="mb-6 hidden">
            <label class="block text-sm font-semibold text-gray-700 mb-4">
                <i class="fas fa-comment text-yellow-600 mr-2"></i> Image Captions (Optional)
            </label>
            <div id="captionsList" class="space-y-3"></div>
        </div>

        <!-- Featured Checkbox -->
        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 text-yellow-600 rounded">
                <span class="ml-2 text-sm text-gray-700">
                    <i class="fas fa-star text-yellow-500 mr-1"></i> Feature this gallery on homepage
                </span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="flex gap-4 mt-8">
            <button type="submit" class="bg-yellow-600 text-white px-8 py-3 rounded-lg hover:bg-yellow-700 transition flex items-center gap-2 font-semibold">
                <i class="fas fa-save"></i> Create Gallery
            </button>
            <a href="{{ route('dashboard.galleries.index') }}" class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition font-semibold">
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

function showImagesPreviews(input) {
    const previewsContainer = document.getElementById('imagesPreviews');
    const captionsContainer = document.getElementById('captionsContainer');
    const captionsList = document.getElementById('captionsList');
    
    previewsContainer.innerHTML = '';
    captionsList.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        previewsContainer.classList.remove('hidden');
        captionsContainer.classList.remove('hidden');
        
        Array.from(input.files).forEach((file, index) => {
            // Show image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-32 object-cover rounded-lg shadow-md">
                    <div class="absolute top-1 right-1 bg-yellow-600 text-white text-xs px-2 py-1 rounded-full">${index + 1}</div>
                `;
                previewsContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
            
            // Add caption input
            const captionDiv = document.createElement('div');
            captionDiv.innerHTML = `
                <label class="block text-xs text-gray-600 mb-1">Image ${index + 1} Caption</label>
                <input type="text" name="captions[]" placeholder="Optional caption for image ${index + 1}" 
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500">
            `;
            captionsList.appendChild(captionDiv);
        });
    } else {
        previewsContainer.classList.add('hidden');
        captionsContainer.classList.add('hidden');
    }
}
</script>
@endsection
