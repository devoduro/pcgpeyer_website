@extends('dashboard.layouts.app')

@section('title', 'View Video')
@section('page-title', $video->title)

@section('content')
<div class="max-w-5xl">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('dashboard.videos.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
            <i class="fas fa-arrow-left mr-2"></i> Back to Videos
        </a>
        <div class="flex gap-2">
            <a href="{{ route('dashboard.videos.edit', $video) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('dashboard.videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Video Player -->
        <div class="bg-black">
            @if($video->video_type === 'youtube' && $video->youtube_id)
                <div class="relative" style="padding-bottom: 56.25%;">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full"
                        src="https://www.youtube.com/embed/{{ $video->youtube_id }}" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            @elseif($video->video_type === 'vimeo' && $video->embed_url)
                <div class="relative" style="padding-bottom: 56.25%;">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full"
                        src="{{ $video->embed_url }}" 
                        frameborder="0" 
                        allow="autoplay; fullscreen; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            @elseif($video->video_type === 'upload' && $video->video_file)
                <video controls class="w-full">
                    <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else
                <div class="flex items-center justify-center h-96">
                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="max-h-full">
                </div>
            @endif
        </div>

        <!-- Video Info -->
        <div class="p-8">
            <!-- Title and Status -->
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $video->title }}</h1>
                    <div class="flex gap-2 flex-wrap">
                        @if($video->featured)
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i> Featured
                            </span>
                        @endif
                        @if($video->published)
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-check mr-1"></i> Published
                            </span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-times mr-1"></i> Draft
                            </span>
                        @endif
                        @if($video->category)
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-folder mr-1"></i> {{ $video->category }}
                            </span>
                        @endif
                        <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold uppercase">
                            <i class="fas fa-video mr-1"></i> {{ $video->video_type }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($video->description)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $video->description }}</p>
                </div>
            @endif

            <!-- Video Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-gray-600 mb-2">
                        <i class="fas fa-calendar text-indigo-600 mr-2"></i> Created Date
                    </h4>
                    <p class="text-gray-900">{{ $video->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>

                @if($video->publish_date)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-600 mb-2">
                            <i class="fas fa-calendar-check text-indigo-600 mr-2"></i> Publish Date
                        </h4>
                        <p class="text-gray-900">{{ $video->publish_date->format('F d, Y') }}</p>
                    </div>
                @endif

                @if($video->duration)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-600 mb-2">
                            <i class="fas fa-clock text-indigo-600 mr-2"></i> Duration
                        </h4>
                        <p class="text-gray-900">{{ $video->duration }}</p>
                    </div>
                @endif

                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-gray-600 mb-2">
                        <i class="fas fa-eye text-indigo-600 mr-2"></i> Views
                    </h4>
                    <p class="text-gray-900">{{ number_format($video->views) }}</p>
                </div>

                @if($video->video_url)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-600 mb-2">
                            <i class="fas fa-link text-indigo-600 mr-2"></i> Video URL
                        </h4>
                        <a href="{{ $video->video_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 break-all">
                            {{ $video->video_url }}
                        </a>
                    </div>
                @endif

                @if($video->video_file)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-600 mb-2">
                            <i class="fas fa-file-video text-indigo-600 mr-2"></i> Video File
                        </h4>
                        <p class="text-gray-900">{{ basename($video->video_file) }}</p>
                    </div>
                @endif

                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-semibold text-gray-600 mb-2">
                        <i class="fas fa-clock text-indigo-600 mr-2"></i> Last Updated
                    </h4>
                    <p class="text-gray-900">{{ $video->updated_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="flex gap-3 flex-wrap">
                    <form action="{{ route('dashboard.videos.toggle-featured', $video) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                            <i class="fas fa-star mr-2"></i> {{ $video->featured ? 'Unfeature' : 'Feature' }}
                        </button>
                    </form>

                    <form action="{{ route('dashboard.videos.toggle-published', $video) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-{{ $video->published ? 'red' : 'green' }}-600 hover:bg-{{ $video->published ? 'red' : 'green' }}-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                            <i class="fas fa-{{ $video->published ? 'eye-slash' : 'check' }} mr-2"></i> {{ $video->published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </form>

                    <a href="{{ $video->video_url }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                        <i class="fas fa-external-link-alt mr-2"></i> View on Platform
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
