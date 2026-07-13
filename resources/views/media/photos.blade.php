@extends('layouts.app')

@section('title', 'Photo Gallery - PCG Monninger Congregation')

@section('content')
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=1920&h=600&fit=crop" alt="Photo Gallery" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-blue-800/90 to-pcg-blue-900/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="icon-circle-lg bg-white/20 backdrop-blur-lg border-2 border-white/30 mx-auto mb-8 animate-bounce-slow">
            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">Photo Gallery</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">Capturing Moments of Faith, Fellowship & Service</p>
        <div class="w-24 h-1 bg-pcg-blue-400 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<!-- Category Filter -->
@if($categories->count() > 0)
<section class="py-8 bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-3" data-aos="fade-up">
            <a href="{{ route('media.photos') }}" 
               class="px-6 py-3 rounded-full font-semibold transition duration-300 shadow-md {{ !request('category') ? 'bg-pcg-blue-600 text-white' : 'bg-white text-pcg-blue-900 hover:bg-pcg-blue-50' }}">
                <i class="fas fa-th mr-2"></i>All Photos
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('media.photos', ['category' => $cat]) }}" 
                   class="px-6 py-3 rounded-full font-semibold transition duration-300 shadow-md {{ request('category') == $cat ? 'bg-pcg-blue-600 text-white' : 'bg-white text-pcg-blue-900 hover:bg-pcg-blue-50' }}">
                    <i class="fas fa-folder mr-2"></i>{{ $cat }}
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Photo Gallery Grid -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleries as $index => $gallery)
                    <a href="{{ route('gallery.show', $gallery->id) }}" 
                       class="group block bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-700 transform hover:-translate-y-2"
                       data-aos="fade-up" 
                       data-aos-delay="{{ (($index % 3) + 1) * 100 }}">
                        
                        <!-- Image Container -->
                        <div class="relative h-80 overflow-hidden bg-gray-100">
                            @if($gallery->thumbnail_path)
                                <img src="{{ asset('storage/' . $gallery->thumbnail_path) }}" 
                                     alt="{{ $gallery->title }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                                     loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <i class="fas fa-images text-6xl text-gray-400"></i>
                                </div>
                            @endif
                            
                            <!-- Subtle Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <!-- Photo Count Badge -->
                            @if($gallery->images && $gallery->images->count() > 0)
                                <div class="absolute top-6 right-6 bg-white text-gray-900 px-4 py-2 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm">
                                    <i class="fas fa-images mr-2 text-pcg-red-600"></i>{{ $gallery->images->count() }}
                                </div>
                            @endif
                            
                            <!-- View Indicator -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                                <div class="w-20 h-20 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-500 shadow-xl">
                                    <i class="fas fa-arrow-right text-pcg-blue-900 text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content Container -->
                        <div class="p-8">
                            @if($gallery->category)
                                <div class="mb-3">
                                    <span class="inline-block px-3 py-1 bg-pcg-blue-100 text-pcg-blue-800 text-xs font-semibold rounded-full">
                                        <i class="fas fa-folder mr-1"></i>{{ $gallery->category }}
                                    </span>
                                </div>
                            @endif
                            
                            <div class="flex items-start justify-between mb-4">
                                <h3 class="text-2xl font-bold text-gray-900 group-hover:text-pcg-blue-900 transition-colors duration-300 flex-1 pr-4 leading-tight">
                                    {{ $gallery->title }}
                                </h3>
                            </div>
                            
                            @if($gallery->description)
                                <p class="text-gray-600 leading-relaxed mb-6 line-clamp-2">
                                    {{ $gallery->description }}
                                </p>
                            @endif
                            
                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="far fa-calendar mr-2"></i>
                                    <span>{{ $gallery->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex items-center text-pcg-red-600 font-semibold text-sm group-hover:text-pcg-blue-900 transition-colors duration-300">
                                    <span class="mr-2">View Gallery</span>
                                    <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($galleries->hasPages())
                <div class="mt-16">
                    {{ $galleries->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <i class="fas fa-images text-8xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-4">No Photo Galleries Yet</h3>
                <p class="text-gray-500 text-lg">Check back soon for photo galleries from our church events and activities.</p>
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
