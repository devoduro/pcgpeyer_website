@extends('layouts.app')

@section('title', $gallery->title)

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lg-zoom.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lg-thumbnail.min.css">
@endsection

@section('content')
<div class="bg-gradient-to-r from-primary-dark to-primary py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center text-white mb-6">
                <a href="{{ route('gallery') }}" class="flex items-center hover:underline">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Galleries
                </a>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $gallery->title }}</h1>
            @if($gallery->description)
                <p class="text-xl text-white opacity-90 mb-4">{{ $gallery->description }}</p>
            @endif
            <div class="flex items-center text-white opacity-80">
                <span>Created {{ $gallery->created_at->format('M d, Y') }}</span>
                <span class="mx-2">•</span>
                <span>{{ $gallery->images->count() }} photos</span>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-12">
    <div class="container mx-auto px-4">
        @if($gallery->images->count() > 0)
            <div id="lightgallery" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($gallery->images as $image)
                    <a href="{{ asset('storage/' . $image->image_path) }}" 
                       class="gallery-item relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1"
                       data-sub-html="<h4>{{ $image->caption ?? $gallery->title }}</h4>">
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="{{ $image->caption ?? $gallery->title }}" 
                             class="w-full h-64 object-cover">
                        @if($image->caption)
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-2 text-sm">
                                {{ $image->caption }}
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No images in this gallery</h3>
                <p class="mt-1 text-gray-500">This gallery doesn't have any images yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lightGallery(document.getElementById('lightgallery'), {
            selector: '.gallery-item',
            plugins: [lgZoom, lgThumbnail],
            speed: 500,
            download: false
        });
    });
</script>
@endsection