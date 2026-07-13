@extends('layouts.app')

@section('title', 'Project Videos')

@section('content')
<div class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-primary-dark mb-2">Project Videos</h1>
            <nav class="text-sm font-medium">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 transition">Home</a></li>
                    <li class="flex items-center">
                        <svg class="h-4 w-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Videos</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <!-- Featured Videos Section -->
    @if($featuredVideos->count() > 0)
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <svg class="h-6 w-6 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            Featured Videos
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredVideos as $featuredVideo)
            <div class="group">
                <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl h-full flex flex-col">
                    <a href="{{ route('videos.show', $featuredVideo->id) }}" class="block relative">
                        <div class="relative aspect-video overflow-hidden">
                            <img src="{{ $featuredVideo->thumbnail_url }}" class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105" alt="{{ $featuredVideo->title }}">
                            <div class="absolute top-2 right-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-3 py-1 rounded-full text-xs font-medium flex items-center">
                                <svg class="h-3 w-3 text-yellow-300 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                Featured
                            </div>
                            @if($featuredVideo->duration)
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs font-medium">
                                <svg class="h-3 w-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $featuredVideo->duration ?? 'N/A' }}
                            </div>
                            @endif
                            <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                    <div class="p-5 flex-grow">
                        <h3 class="font-bold text-lg mb-2 line-clamp-2">
                            <a href="{{ route('videos.show', $featuredVideo->id) }}" class="text-gray-800 hover:text-blue-600 transition">
                                {{ $featuredVideo->title }}
                            </a>
                        </h3>
                        <div class="flex items-center text-gray-500 text-sm mb-3">
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $featuredVideo->created_at->format('M d, Y') }}
                            </span>
                            <span class="mx-2">•</span>
                            <span class="flex items-center">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $featuredVideo->views }} views
                            </span>
                        </div>
                        <p class="text-gray-600 line-clamp-3 text-sm mb-3">{{ $featuredVideo->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Video Filter Section -->
    <section class="mb-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    All Videos
                </h2>
            </div>
            <div class="w-full md:w-64">
                <form action="{{ route('videos') }}" method="GET">
                    <div class="relative">
                        <select name="category" class="block w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" onchange="this.form.submit()">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Video Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @if($videos->count() > 0)
                @foreach($videos as $video)
                <div class="group">
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg h-full flex flex-col">
                        <a href="{{ route('videos.show', $video->id) }}" class="block relative">
                            <div class="relative aspect-video overflow-hidden">
                                <img src="{{ $video->thumbnail_url }}" class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-105" alt="{{ $video->title }}">
                                @if($video->duration)
                                <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white px-2 py-1 rounded text-xs font-medium">
                                    <svg class="h-3 w-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $video->duration }}
                                </div>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="h-12 w-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="p-4 flex-grow flex flex-col">
                            <h3 class="font-medium text-base mb-1 line-clamp-2">
                                <a href="{{ route('videos.show', $video->id) }}" class="text-gray-800 hover:text-blue-600 transition">
                                    {{ $video->title }}
                                </a>
                            </h3>
                            <div class="flex items-center text-gray-500 text-xs mb-2 mt-auto">
                                <span class="flex items-center">
                                    <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $video->created_at->format('M d, Y') }}
                                </span>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ $video->views }}
                                </span>
                            </div>
                            @if($video->category)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                {{ $video->category }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-span-full">
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-blue-700">No videos found. {{ $category ? 'Try selecting a different category.' : '' }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $videos->links() }}
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
    /* Line clamp utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Aspect ratio for thumbnails */
    .aspect-video {
        aspect-ratio: 16 / 9;
    }
</style>
@endsection
