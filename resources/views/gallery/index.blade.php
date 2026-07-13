@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<div class="bg-gradient-to-r from-primary-dark to-primary py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Photo Gallery</h1>
            <p class="text-xl text-white opacity-90">
                Browse our collection of project photos and activities
            </p>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleries as $gallery)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                        <a href="{{ route('gallery.show', $gallery->id) }}" class="block relative pb-[60%] overflow-hidden">
                            <img src="{{ asset('storage/' . $gallery->thumbnail_path) }}" alt="{{ $gallery->title }}" class="absolute inset-0 w-full h-full object-cover">
                        </a>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                <a href="{{ route('gallery.show', $gallery->id) }}" class="hover:text-primary-dark">{{ $gallery->title }}</a>
                            </h3>
                            @if($gallery->description)
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $gallery->description }}</p>
                            @endif
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $gallery->images->count() }} photos</span>
                                <a href="{{ route('gallery.show', $gallery->id) }}" class="text-primary-dark hover:text-primary font-medium flex items-center">
                                    View Gallery
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $galleries->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900">No galleries available</h3>
                <p class="mt-2 text-gray-500">Check back later for new photo galleries.</p>
            </div>
        @endif
    </div>
</div>
@endsection