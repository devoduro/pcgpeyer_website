@extends('dashboard.layouts.app')

@section('title', 'Add Leadership Member')
@section('page-title', 'Add Leadership Member')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.leadership.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="title_id" class="block text-sm font-semibold text-gray-700 mb-2">Title/Position *</label>
                <select id="title_id" name="title_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('title_id') border-red-500 @enderror">
                    <option value="">-- Select a Title --</option>
                    @foreach($titles as $title)
                        <option value="{{ $title->id }}" {{ old('title_id') == $title->id ? 'selected' : '' }}>
                            {{ $title->title }}
                            @if($title->description)
                                ({{ $title->description }})
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('title_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('email') border-red-500 @enderror">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">Biography</label>
            <textarea id="bio" name="bio" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
            @error('bio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-3 gap-6 mb-6">
            <div>
                <label for="year" class="block text-sm font-semibold text-gray-700 mb-2">Year *</label>
                <select id="year" name="year" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('year') border-red-500 @enderror">
                    <option value="">-- Select a Year --</option>
                    @foreach($years as $year)
                        <option value="{{ $year->year }}" {{ old('year') == $year->year ? 'selected' : '' }}>
                            {{ $year->yearRange }}
                            @if($year->description)
                                ({{ $year->description }})
                            @endif
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1"><a href="{{ route('dashboard.leadership.manage-years') }}" class="text-cyan-600 hover:underline">Manage years</a></p>
                @error('year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Profile Image</label>
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
            </div>
        </div>

        <div class="mb-6 space-y-3">
            <label class="flex items-center">
                <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="h-4 w-4 text-cyan-600">
                <span class="ml-2 text-sm text-gray-700">Active (Display on website)</span>
            </label>
            
            <label class="flex items-center">
                <input type="checkbox" name="is_current" value="1" {{ old('is_current', false) ? 'checked' : '' }} class="h-4 w-4 text-cyan-600">
                <span class="ml-2 text-sm text-gray-700">
                    <strong>Current Leadership Term</strong>
                    <span class="block text-xs text-gray-500 mt-1">Mark this as the current leadership term (will show special badge)</span>
                </span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition flex items-center gap-2">
                <i class="fas fa-save"></i> Create Member
            </button>
            <a href="{{ route('dashboard.leadership.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
