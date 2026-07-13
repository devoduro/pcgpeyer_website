@extends('dashboard.layouts.app')

@section('title', 'Add Group Leadership')
@section('page-title', 'Add Group Leadership')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('dashboard.group-leadership.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Group Name *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror">
            @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Group Image</label>
                <div class="relative">
                    <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('image') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB (JPG, PNG, GIF)</p>
                </div>
                @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="display_order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                <input type="number" id="display_order" name="display_order" value="{{ old('display_order', 0) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('display_order') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                @error('display_order') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-8">
            <label class="flex items-center">
                <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="h-4 w-4 text-cyan-600">
                <span class="ml-2 text-sm text-gray-700">Active (Display on website)</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition flex items-center gap-2">
                <i class="fas fa-save"></i> Create Group
            </button>
            <a href="{{ route('dashboard.group-leadership.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
