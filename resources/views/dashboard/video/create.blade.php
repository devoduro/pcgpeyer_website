@extends('dashboard.layouts.app')

@section('title', 'Create Video')
@section('page-title', 'Add New Video')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('dashboard.videos.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
            <i class="fas fa-arrow-left mr-2"></i> Back to Videos
        </a>
    </div>

    <form action="{{ route('dashboard.videos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <!-- Video Title -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-heading text-indigo-600 mr-2"></i> Video Title
            </label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror"
                   placeholder="e.g., Sunday Service - November 2024">
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Video Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-align-left text-indigo-600 mr-2"></i> Description
            </label>
            <textarea id="description" name="description" rows="4" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                      placeholder="Brief description of the video...">{{ old('description') }}</textarea>
            @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Category -->
        <div class="mb-6">
            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-folder text-indigo-600 mr-2"></i> Category
            </label>
            <select id="category" name="category" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option value="">Select a category</option>
                <option value="Sermons" {{ old('category') == 'Sermons' ? 'selected' : '' }}>Sermons</option>
                <option value="Testimonies" {{ old('category') == 'Testimonies' ? 'selected' : '' }}>Testimonies</option>
                <option value="Special Events" {{ old('category') == 'Special Events' ? 'selected' : '' }}>Special Events</option>
                <option value="Cultural Events" {{ old('category') == 'Cultural Events' ? 'selected' : '' }}>Cultural Events</option>
                <option value="Teachings" {{ old('category') == 'Teachings' ? 'selected' : '' }}>Teachings</option>
                <option value="Worship" {{ old('category') == 'Worship' ? 'selected' : '' }}>Worship</option>
                <option value="Youth Ministry" {{ old('category') == 'Youth Ministry' ? 'selected' : '' }}>Youth Ministry</option>
                <option value="Health & Safety" {{ old('category') == 'Health & Safety' ? 'selected' : '' }}>Health & Safety</option>
                <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('category')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Video Type -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-video text-indigo-600 mr-2"></i> Video Type
            </label>
            <div class="flex gap-4">
                <label class="flex items-center">
                    <input type="radio" name="video_type" value="youtube" {{ old('video_type', 'youtube') == 'youtube' ? 'checked' : '' }} 
                           class="mr-2" onchange="toggleVideoFields()" required>
                    <i class="fab fa-youtube text-red-600 mr-1"></i> YouTube
                </label>
                <label class="flex items-center">
                    <input type="radio" name="video_type" value="vimeo" {{ old('video_type') == 'vimeo' ? 'checked' : '' }} 
                           class="mr-2" onchange="toggleVideoFields()">
                    <i class="fab fa-vimeo text-blue-600 mr-1"></i> Vimeo
                </label>
                <label class="flex items-center">
                    <input type="radio" name="video_type" value="upload" {{ old('video_type') == 'upload' ? 'checked' : '' }} 
                           class="mr-2" onchange="toggleVideoFields()">
                    <i class="fas fa-upload text-green-600 mr-1"></i> Upload File
                </label>
            </div>
            @error('video_type')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Video URL (YouTube/Vimeo) -->
        <div id="video_url_field" class="mb-6">
            <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-link text-indigo-600 mr-2"></i> Video URL
            </label>
            <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                   placeholder="https://www.youtube.com/watch?v=...">
            <p class="text-xs text-gray-500 mt-1">Paste the full YouTube or Vimeo URL</p>
            @error('video_url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Video File Upload -->
        <div id="video_file_field" class="mb-6" style="display: none;">
            <label for="video_file" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-file-video text-indigo-600 mr-2"></i> Video File
            </label>
            <input type="file" id="video_file" name="video_file" accept="video/*" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
            <p class="text-xs text-gray-500 mt-1">Supported formats: MP4, MOV, AVI, WMV (Max: 100MB)</p>
            @error('video_file')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Thumbnail Upload -->
        <div class="mb-6">
            <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-image text-indigo-600 mr-2"></i> Thumbnail (Optional)
            </label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                   onchange="previewThumbnail(this)">
            <p class="text-xs text-gray-500 mt-1">If not provided, YouTube/Vimeo thumbnail will be used automatically</p>
            <div id="thumbnailPreview" class="mt-4 hidden">
                <img id="thumbnailImg" src="" alt="Thumbnail Preview" class="max-h-48 rounded-lg shadow-md">
            </div>
            @error('thumbnail')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Duration -->
        <div class="mb-6">
            <label for="duration" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-clock text-indigo-600 mr-2"></i> Duration (Optional)
            </label>
            <input type="text" id="duration" name="duration" value="{{ old('duration') }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                   placeholder="e.g., 45:30">
            @error('duration')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Publish Date -->
        <div class="mb-6">
            <label for="publish_date" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fas fa-calendar text-indigo-600 mr-2"></i> Publish Date (Optional)
            </label>
            <input type="date" id="publish_date" name="publish_date" value="{{ old('publish_date') }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            @error('publish_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Checkboxes -->
        <div class="mb-6 space-y-3">
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 rounded">
                <span class="ml-2 text-sm text-gray-700">
                    <i class="fas fa-star text-yellow-500 mr-1"></i> Feature this video
                </span>
            </label>
            
            <label class="flex items-center">
                <input type="checkbox" name="published" value="1" {{ old('published', true) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 rounded">
                <span class="ml-2 text-sm text-gray-700">
                    <i class="fas fa-check-circle text-green-500 mr-1"></i> Publish this video
                </span>
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold shadow-md transition duration-300">
                <i class="fas fa-save mr-2"></i> Create Video
            </button>
            <a href="{{ route('dashboard.videos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-semibold shadow-md transition duration-300">
                <i class="fas fa-times mr-2"></i> Cancel
            </a>
        </div>
    </form>
</div>

<script>
function toggleVideoFields() {
    const videoType = document.querySelector('input[name="video_type"]:checked').value;
    const urlField = document.getElementById('video_url_field');
    const fileField = document.getElementById('video_file_field');
    
    if (videoType === 'youtube' || videoType === 'vimeo') {
        urlField.style.display = 'block';
        fileField.style.display = 'none';
    } else {
        urlField.style.display = 'none';
        fileField.style.display = 'block';
    }
}

function previewThumbnail(input) {
    const preview = document.getElementById('thumbnailPreview');
    const img = document.getElementById('thumbnailImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
