@extends('dashboard.layouts.app')

@section('title', 'Create Event')
@section('page-title', 'Create New Event')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.events.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Event Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('title') border-red-500 @enderror">
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Full Details</label>
            <textarea id="content" name="content" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ old('content') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Start Date & Time</label>
                <input type="datetime-local" id="start_date" name="start_date" value="{{ old('start_date') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('start_date') border-red-500 @enderror">
                @error('start_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">End Date & Time</label>
                <input type="datetime-local" id="end_date" name="end_date" value="{{ old('end_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Event venue">
            </div>

            <div>
                <label for="organizer" class="block text-sm font-semibold text-gray-700 mb-2">Organizer</label>
                <input type="text" id="organizer" name="organizer" value="{{ old('organizer') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
        </div>

        <div class="mb-6">
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Event Image</label>
            <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>

        <div class="flex gap-4 mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Featured Event</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="published" value="1" {{ old('published', true) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Published</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-save mr-2"></i> Create Event
            </button>
            <a href="{{ route('dashboard.events.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
