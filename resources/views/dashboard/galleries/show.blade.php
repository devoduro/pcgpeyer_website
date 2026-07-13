@extends('dashboard.layouts.app')

@section('title', $gallery->title)
@section('page-title', $gallery->title)

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold text-gray-900">{{ $gallery->title }}</h3>
        @if($gallery->description)
            <p class="text-gray-600 mt-2">{{ $gallery->description }}</p>
        @endif
    </div>
    <div class="flex gap-2">
        <a href="{{ route('dashboard.galleries.edit', $gallery) }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
            <i class="fas fa-edit"></i> Edit Gallery
        </a>
        <a href="{{ route('dashboard.galleries.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>

<!-- Gallery Info -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div>
            <p class="text-sm text-gray-600">Total Images</p>
            <p class="text-2xl font-bold text-gray-900">{{ $gallery->images->count() }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Created By</p>
            <p class="text-lg font-semibold text-gray-900">{{ $gallery->creator->name ?? 'Unknown' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Created</p>
            <p class="text-lg font-semibold text-gray-900">{{ $gallery->created_at->format('M d, Y') }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Status</p>
            <p class="text-lg font-semibold">
                @if($gallery->is_featured)
                    <span class="text-yellow-600"><i class="fas fa-star"></i> Featured</span>
                @else
                    <span class="text-gray-600">Regular</span>
                @endif
            </p>
        </div>
    </div>
</div>

<!-- Gallery Images -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h4 class="text-lg font-bold text-gray-900 mb-4">Gallery Images</h4>
    
    @if($gallery->images->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($gallery->images as $image)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         alt="{{ $image->caption ?? 'Gallery image' }}" 
                         class="w-full h-48 object-cover rounded-lg shadow-md group-hover:shadow-xl transition">
                    @if($image->caption)
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white p-2 text-xs rounded-b-lg opacity-0 group-hover:opacity-100 transition">
                            {{ $image->caption }}
                        </div>
                    @endif
                    <div class="absolute top-2 left-2 bg-yellow-600 text-white text-xs px-2 py-1 rounded-full">
                        #{{ $image->display_order + 1 }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <i class="fas fa-images text-4xl mb-4 opacity-30"></i>
            <p>No images in this gallery yet</p>
        </div>
    @endif
</div>

<!-- Delete Gallery -->
<div class="mt-6">
    <form action="{{ route('dashboard.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this gallery and all its images? This action cannot be undone.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition flex items-center gap-2">
            <i class="fas fa-trash"></i> Delete Gallery
        </button>
    </form>
</div>
@endsection
