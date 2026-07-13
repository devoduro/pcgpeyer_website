@extends('layouts.app')

@section('title', $video->title)

@section('content')
<div class="bg-gradient-to-r from-blue-50 to-indigo-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 line-clamp-2">{{ $video->title }}</h1>
            <nav class="text-sm font-medium">
                <ol class="flex flex-wrap items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 transition">Home</a></li>
                    <li class="flex items-center">
                        <svg class="h-4 w-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('videos') }}" class="text-blue-600 hover:text-blue-800 transition">Videos</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="h-4 w-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-600 truncate max-w-xs">{{ Str::limit($video->title, 30) }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Main Video Content -->
        <div class="lg:col-span-8">
            <!-- Video Player -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="aspect-video w-full">
                    @if($video->video_type == 'youtube' || $video->video_type == 'vimeo')
                        <iframe src="{{ $video->embed_url }}" title="{{ $video->title }}" class="w-full h-full" allowfullscreen></iframe>
                    @elseif($video->video_type == 'upload' && $video->video_file)
                        <video controls class="w-full h-full object-contain bg-black">
                            <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <div class="flex items-center justify-center bg-gray-100 h-full w-full">
                            <div class="text-center p-6">
                                <svg class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500">Video not available</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Video Info -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $video->title }}</h2>
                    
                    <div class="flex flex-wrap items-center space-x-4 text-sm text-gray-600 mb-4">
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $video->created_at->format('M d, Y') }}
                        </span>
                        @if($video->duration)
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $video->duration }}
                        </span>
                        @endif
                        <span class="flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $video->views }} views
                        </span>
                    </div>
                    
                    @if($video->category)
                    <div class="mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $video->category }}
                        </span>
                    </div>
                    @endif
                    
                    @if($video->description)
                    <div class="prose max-w-none text-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                        <div class="text-gray-600">
                            {!! nl2br(e($video->description)) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Social Share Buttons -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Share this video</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('videos.show', $video->id)) }}" target="_blank" class="flex items-center px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 transition">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                            </svg>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('videos.show', $video->id)) }}&text={{ urlencode($video->title) }}" target="_blank" class="flex items-center px-4 py-2 rounded-md bg-blue-400 text-white hover:bg-blue-500 transition">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/>
                            </svg>
                            Twitter
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('videos.show', $video->id)) }}&title={{ urlencode($video->title) }}" target="_blank" class="flex items-center px-4 py-2 rounded-md bg-blue-800 text-white hover:bg-blue-900 transition">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                            LinkedIn
                        </a>
                        <button class="flex items-center px-4 py-2 rounded-md bg-gray-200 text-gray-800 hover:bg-gray-300 transition copy-link" data-url="{{ route('videos.show', $video->id) }}">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"></path>
                            </svg>
                            Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-4">
            <!-- Related Videos -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <h3 class="text-lg font-medium text-white">Related Videos</h3>
                </div>
                <div class="p-4">
                    @if($relatedVideos->count() > 0)
                        <div class="space-y-4">
                            @foreach($relatedVideos as $relatedVideo)
                                <a href="{{ route('videos.show', $relatedVideo->id) }}" class="flex items-start space-x-3 group hover:bg-gray-50 p-2 rounded-lg transition">
                                    <div class="flex-shrink-0 relative">
                                        <img src="{{ $relatedVideo->thumbnail_url }}" alt="{{ $relatedVideo->title }}" class="w-24 h-16 object-cover rounded-md" width="96">
                                        <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        @if($relatedVideo->duration)
                                            <span class="absolute bottom-1 right-1 bg-black bg-opacity-70 text-white text-xs px-1.5 py-0.5 rounded">
                                                {{ $relatedVideo->duration }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-blue-600 transition">{{ $relatedVideo->title }}</h4>
                                        <div class="flex items-center text-xs text-gray-500 mt-1">
                                            <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $relatedVideo->views }} views
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="h-12 w-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                            </svg>
                            <p class="text-gray-500">No related videos found.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Categories -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <h3 class="text-lg font-medium text-white">Video Categories</h3>
                </div>
                <div class="p-4">
                    <div class="space-y-2">
                        <a href="{{ route('videos') }}" class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg transition group">
                            <span class="font-medium text-gray-800 group-hover:text-blue-600">All Videos</span>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ \App\Models\Video::published()->count() }}</span>
                        </a>
                        @foreach(\App\Models\Video::select('category')->distinct()->whereNotNull('category')->pluck('category') as $cat)
                            <a href="{{ route('videos', ['category' => $cat]) }}" class="flex justify-between items-center p-3 hover:bg-gray-50 rounded-lg transition group">
                                <span class="font-medium text-gray-800 group-hover:text-blue-600">{{ $cat }}</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ \App\Models\Video::published()->where('category', $cat)->count() }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Copy link to clipboard
        $('.copy-link').click(function() {
            var url = $(this).data('url');
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(url).select();
            document.execCommand('copy');
            tempInput.remove();
            
            // Original button text
            var originalText = $(this).html();
            
            // Change button text to show success
            $(this).html('<svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg> Copied!');
            $(this).removeClass('bg-gray-200 text-gray-800').addClass('bg-green-100 text-green-800');
            
            // Reset button after 2 seconds
            setTimeout(() => {
                $(this).html(originalText);
                $(this).removeClass('bg-green-100 text-green-800').addClass('bg-gray-200 text-gray-800');
            }, 2000);
        });
    });
</script>
@endsection
