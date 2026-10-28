@extends('layouts.app')

@section('title', 'Videos - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
@include('partials.page-hero', [
    'title' => 'Video Gallery',
    'eyebrow' => 'Media',
    'subtitle' => 'Watch sermons, events and testimonies from our congregation.',
    'image' => 'images/bantama/choir.jpg',
    'crumbs' => [['Media', route('media.photos')], ['Videos']],
])

<!-- Category Filter -->
@if($categories->count() > 0)
<section class="py-8 bg-gray-50 border-b border-gray-200">
    <div class="site">
        <div class="flex flex-wrap items-center justify-center gap-3" data-aos="fade-up">
            <a href="{{ route('media.videos') }}" 
               class="px-6 py-3 rounded-full font-semibold transition duration-300 shadow-md {{ !request('category') ? 'bg-pcg-blue-600 text-white' : 'bg-white text-pcg-blue-900 hover:bg-pcg-blue-50' }}">
                <i class="fas fa-video mr-2"></i>All Videos
            </a>
            @foreach($categories as $cat)
                @php $isSermonCat = strtolower($cat) === 'sermons'; @endphp
                <a href="{{ route('media.videos', ['category' => $cat]) }}"
                   class="px-6 py-3 rounded-full font-semibold transition duration-300 shadow-md {{ request('category') == $cat ? ($isSermonCat ? 'bg-pcg-gold-500 text-white' : 'bg-pcg-blue-600 text-white') : ($isSermonCat ? 'bg-white text-pcg-gold-700 hover:bg-pcg-gold-50' : 'bg-white text-pcg-blue-900 hover:bg-pcg-blue-50') }}">
                    <i class="{{ $isSermonCat ? 'fas fa-bible' : 'fas fa-folder' }} mr-2"></i>{{ $cat }}
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Video Gallery Grid -->
<section class="py-20 bg-white">
    <div class="site">
        @if($videos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($videos as $index => $video)
                <a href="{{ $video->video_url }}" target="_blank" class="group cursor-pointer block" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                    <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            
                            <!-- Play Button Overlay -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-20 h-20 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center group-hover:scale-110 group-hover:bg-pcg-blue-600 transition-all duration-300 shadow-2xl">
                                    <svg class="w-10 h-10 text-pcg-blue-900 group-hover:text-white ml-1 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Category Badge -->
                            @if($video->category)
                                @php $isSermon = strtolower($video->category) === 'sermons'; @endphp
                                <div class="absolute top-4 right-4 flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold shadow-lg {{ $isSermon ? 'bg-pcg-gold-500 text-white' : 'bg-pcg-red-600 text-white' }}">
                                    @if($isSermon)
                                        <i class="fas fa-bible"></i>
                                    @endif
                                    {{ $video->category }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-pcg-blue-900 mb-2 group-hover:text-pcg-blue-700 transition-colors duration-300 line-clamp-2">{{ $video->title }}</h3>
                            @if($video->description)
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $video->description }}</p>
                            @endif
                            <div class="flex items-center justify-between text-gray-500 text-sm">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $video->publish_date ? $video->publish_date->format('M Y') : $video->created_at->format('M Y') }}</span>
                                </div>
                                @if($video->views > 0)
                                    <div class="flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span>{{ number_format($video->views) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($videos->hasPages())
                <div class="mt-16">
                    {{ $videos->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <i class="fas fa-video text-8xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-4">No Videos Yet</h3>
                <p class="text-gray-500 text-lg">Check back soon for video content from our church.</p>
            </div>
        @endif
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Custom animations */
    @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    @keyframes expand {
        from {
            width: 0;
        }
        to {
            width: 6rem;
        }
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    .animate-expand {
        animation: expand 1s ease-out forwards;
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush
