@extends('dashboard.layouts.app')

@section('title', 'Create Announcement')
@section('page-title', 'Create New Announcement')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.announcements.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('title') border-red-500 @enderror">
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
            <textarea id="message" name="message" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
            @error('message')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Type</label>
                <select id="type" name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                    <option value="info" {{ old('type', 'info') === 'info' ? 'selected' : '' }}>Info</option>
                    <option value="urgent" {{ old('type') === 'urgent' ? 'selected' : '' }}>Urgent</option>
                    <option value="event" {{ old('type') === 'event' ? 'selected' : '' }}>Event</option>
                </select>
            </div>
            <div>
                <label for="display_order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                <input type="number" id="display_order" name="display_order" value="{{ old('display_order', 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="link_url" class="block text-sm font-semibold text-gray-700 mb-2">Link URL (optional)</label>
                <input type="url" id="link_url" name="link_url" value="{{ old('link_url') }}" placeholder="https://..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('link_url') border-red-500 @enderror">
                @error('link_url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="link_text" class="block text-sm font-semibold text-gray-700 mb-2">Link Button Text</label>
                <input type="text" id="link_text" name="link_text" value="{{ old('link_text') }}" placeholder="Learn More" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="starts_at" class="block text-sm font-semibold text-gray-700 mb-2">Show From (optional)</label>
                <input type="datetime-local" id="starts_at" name="starts_at" value="{{ old('starts_at') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-500 mt-1">Leave blank to show immediately.</p>
            </div>
            <div>
                <label for="expires_at" class="block text-sm font-semibold text-gray-700 mb-2">Expires (optional)</label>
                <input type="datetime-local" id="expires_at" name="expires_at" value="{{ old('expires_at') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('expires_at') border-red-500 @enderror">
                @error('expires_at')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                <p class="text-xs text-gray-500 mt-1">Leave blank to never expire.</p>
            </div>
        </div>

        <div class="flex gap-4 mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="pinned" value="1" {{ old('pinned') ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Pin to top</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="published" value="1" {{ old('published', true) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Published</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-save mr-2"></i> Create Announcement
            </button>
            <a href="{{ route('dashboard.announcements.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
