@extends('dashboard.layouts.app')

@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Event Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Full Details</label>
            <textarea id="content" name="content" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">{{ old('content', $event->content) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Start Date & Time</label>
                <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date', $event->start_date?->format('Y-m-d\TH:i')) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">End Date & Time</label>
                <input type="datetime-local" id="end_date" name="end_date" value="{{ old('end_date', $event->end_date?->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div>
                <label for="organizer" class="block text-sm font-semibold text-gray-700 mb-2">Organizer</label>
                <input type="text" id="organizer" name="organizer" value="{{ old('organizer', $event->organizer) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>

        <div class="mb-6">
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Event Image</label>
            <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            @if($event->image) <p class="text-xs text-gray-600 mt-1">Current: {{ basename($event->image) }}</p> @endif
        </div>

        <div class="flex gap-4 mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured', $event->featured) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Featured Event</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="published" value="1" {{ old('published', $event->published) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Published</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-save mr-2"></i> Update Event
            </button>
            <a href="{{ route('dashboard.events.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
