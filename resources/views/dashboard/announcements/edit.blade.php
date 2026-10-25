@extends('dashboard.layouts.app')

@section('title', 'Edit Announcement')
@section('page-title', 'Edit Announcement')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.announcements.update', $announcement) }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $announcement->title) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('title') border-red-500 @enderror">
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
            <textarea id="message" name="message" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('message') border-red-500 @enderror">{{ old('message', $announcement->message) }}</textarea>
            @error('message')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Type</label>
                <select id="type" name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                    <option value="info" {{ old('type', $announcement->type) === 'info' ? 'selected' : '' }}>Info</option>
                    <option value="urgent" {{ old('type', $announcement->type) === 'urgent' ? 'selected' : '' }}>Urgent</option>
                    <option value="event" {{ old('type', $announcement->type) === 'event' ? 'selected' : '' }}>Event</option>
                </select>
            </div>
            <div>
                <label for="display_order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $announcement->display_order) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="link_url" class="block text-sm font-semibold text-gray-700 mb-2">Link URL (optional)</label>
                <input type="url" id="link_url" name="link_url" value="{{ old('link_url', $announcement->link_url) }}" placeholder="https://..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('link_url') border-red-500 @enderror">
                @error('link_url')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label for="link_text" class="block text-sm font-semibold text-gray-700 mb-2">Link Button Text</label>
                <input type="text" id="link_text" name="link_text" value="{{ old('link_text', $announcement->link_text) }}" placeholder="Learn More" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="starts_at" class="block text-sm font-semibold text-gray-700 mb-2">Show From (optional)</label>
                <input type="datetime-local" id="starts_at" name="starts_at" value="{{ old('starts_at', $announcement->starts_at?->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                <p class="text-xs text-gray-500 mt-1">Leave blank to show immediately.</p>
            </div>
            <div>
                <label for="expires_at" class="block text-sm font-semibold text-gray-700 mb-2">Expires (optional)</label>
                <input type="datetime-local" id="expires_at" name="expires_at" value="{{ old('expires_at', $announcement->expires_at?->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 @error('expires_at') border-red-500 @enderror">
                @error('expires_at')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                <p class="text-xs text-gray-500 mt-1">Leave blank to never expire.</p>
            </div>
        </div>

        <div class="flex gap-4 mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="pinned" value="1" {{ old('pinned', $announcement->pinned) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Pin to top</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="published" value="1" {{ old('published', $announcement->published) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Published</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-save mr-2"></i> Update Announcement
            </button>
            <a href="{{ route('dashboard.announcements.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
