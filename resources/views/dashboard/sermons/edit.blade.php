@extends('dashboard.layouts.app')

@section('title', 'Edit Sermon')
@section('page-title', 'Edit Sermon')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.sermons.update', $sermon) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $sermon->title) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('title') border-red-500 @enderror">
            </div>

            <div>
                <label for="preacher" class="block text-sm font-semibold text-gray-700 mb-2">Preacher</label>
                <input type="text" id="preacher" name="preacher" value="{{ old('preacher', $sermon->preacher) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('preacher') border-red-500 @enderror">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="sermon_date" class="block text-sm font-semibold text-gray-700 mb-2">Sermon Date</label>
                <input type="date" id="sermon_date" name="sermon_date" value="{{ old('sermon_date', $sermon->sermon_date?->format('Y-m-d')) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <div>
                <label for="series" class="block text-sm font-semibold text-gray-700 mb-2">Series (Optional)</label>
                <input type="text" id="series" name="series" value="{{ old('series', $sermon->series) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
        </div>

        <div class="mb-6">
            <label for="scripture_reference" class="block text-sm font-semibold text-gray-700 mb-2">Scripture Reference</label>
            <input type="text" id="scripture_reference" name="scripture_reference" value="{{ old('scripture_reference', $sermon->scripture_reference) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="e.g., John 3:16-17">
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('description', $sermon->description) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">Sermon Thumbnail</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            @if($sermon->thumbnail) <p class="text-xs text-gray-600 mt-1">Current: {{ basename($sermon->thumbnail) }}</p> @endif
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="audio_url" class="block text-sm font-semibold text-gray-700 mb-2">Audio URL</label>
                <input type="url" id="audio_url" name="audio_url" value="{{ old('audio_url', $sermon->audio_url) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">Video URL</label>
                <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $sermon->video_url) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>

        <div class="flex gap-4 mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured', $sermon->featured) ? 'checked' : '' }} class="h-4 w-4 text-purple-600">
                <span class="ml-2 text-sm text-gray-700">Feature this sermon</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition flex items-center gap-2">
                <i class="fas fa-save"></i> Update Sermon
            </button>
            <a href="{{ route('dashboard.sermons.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
