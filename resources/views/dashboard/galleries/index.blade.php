@extends('dashboard.layouts.app')

@section('title', 'Gallery Management')
@section('page-title', 'Photo Galleries')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Galleries</h3>
    <a href="{{ route('dashboard.galleries.create') }}" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Create New Gallery
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($galleries as $gallery)
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
        <div class="relative h-48 bg-gray-100 overflow-hidden group">
            @if($gallery->thumbnail_path)
                <img src="{{ asset('storage/' . $gallery->thumbnail_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
            @else
                <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                    <i class="fas fa-images text-6xl text-gray-500 opacity-50"></i>
                </div>
            @endif
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-50 transition flex items-center justify-center gap-2">
                <a href="{{ route('dashboard.galleries.show', $gallery) }}" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('dashboard.galleries.edit', $gallery) }}" class="bg-green-600 text-white p-3 rounded-full hover:bg-green-700 transition">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('dashboard.galleries.destroy', $gallery) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this gallery and all its images?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white p-3 rounded-full hover:bg-red-700 transition">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
            @if($gallery->is_featured)
                <div class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                    <i class="fas fa-star"></i> Featured
                </div>
            @endif
        </div>
        <div class="p-4">
            <h4 class="font-bold text-gray-900 text-lg mb-2 truncate">{{ $gallery->title }}</h4>
            @if($gallery->description)
                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $gallery->description }}</p>
            @endif
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-500">
                    <i class="fas fa-images mr-1"></i>
                    {{ $gallery->images->count() }} {{ Str::plural('photo', $gallery->images->count()) }}
                </span>
                <span class="text-gray-400 text-xs">
                    {{ $gallery->created_at->diffForHumans() }}
                </span>
            </div>
            @if($gallery->creator)
                <div class="mt-2 text-xs text-gray-500">
                    <i class="fas fa-user mr-1"></i> {{ $gallery->creator->name }}
                </div>
            @endif
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-16 text-gray-500">
        <i class="fas fa-images text-6xl mb-4 opacity-30"></i>
        <p class="text-lg font-semibold mb-2">No galleries yet</p>
        <p class="text-sm mb-4">Create your first photo gallery to get started</p>
        <a href="{{ route('dashboard.galleries.create') }}" class="inline-flex items-center bg-yellow-600 text-white px-6 py-3 rounded-lg hover:bg-yellow-700 transition">
            <i class="fas fa-plus mr-2"></i> Create Gallery
        </a>
    </div>
    @endforelse
</div>

@if($galleries->hasPages())
<div class="mt-8">
    {{ $galleries->links() }}
</div>
@endif
@endsection
