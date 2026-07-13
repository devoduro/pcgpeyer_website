@extends('layouts.app')

@section('title', 'News Update - PCG Monninger Congregation')

@section('content')
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?w=1920&h=600&fit=crop" alt="News Update" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-blue-800/90 to-pcg-blue-900/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
       
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">News Update</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">News, Updates & Inspirational Content</p>
        <div class="w-24 h-1 bg-pcg-blue-400 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<!-- Blog Categories -->
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-4" data-aos="fade-up">
            <button class="px-6 py-3 bg-pcg-blue-600 text-white rounded-full font-semibold hover:bg-pcg-blue-700 transition duration-300 shadow-lg">All Posts</button>
            <button class="px-6 py-3 bg-white text-pcg-blue-900 rounded-full font-semibold hover:bg-pcg-blue-50 transition duration-300 shadow-md">Sermons</button>
            <button class="px-6 py-3 bg-white text-pcg-blue-900 rounded-full font-semibold hover:bg-pcg-blue-50 transition duration-300 shadow-md">Events</button>
            <button class="px-6 py-3 bg-white text-pcg-blue-900 rounded-full font-semibold hover:bg-pcg-blue-50 transition duration-300 shadow-md">Testimonies</button>
            <button class="px-6 py-3 bg-white text-pcg-blue-900 rounded-full font-semibold hover:bg-pcg-blue-50 transition duration-300 shadow-md">Ministry Updates</button>
        </div>
    </div>
</section>

<!-- Featured Post -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($posts->isNotEmpty())
        @php $featuredPost = $posts->first(); @endphp
        <article class="group cursor-pointer" data-aos="fade-up">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <div class="relative h-96 lg:h-auto overflow-hidden">
                        @if($featuredPost->image)
                            <img src="{{ asset('storage/' . $featuredPost->image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" onerror="this.src='https://images.unsplash.com/photo-1520975916090-3105956dac38?w=1200&h=800&fit=crop'">
                        @else
                            <img src="https://images.unsplash.com/photo-1520975916090-3105956dac38?w=1200&h=800&fit=crop" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @endif
                        <div class="absolute top-6 left-6">
                            <span class="bg-pcg-blue-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">Featured Post</span>
                        </div>
                    </div>
                    <div class="p-8 lg:p-12 flex flex-col justify-center">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-sm text-pcg-blue-600 font-bold">{{ $featuredPost->published_at ? $featuredPost->published_at->format('M d, Y') : 'Recent' }}</span>
                            <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                            <span class="text-sm text-gray-600">By {{ $featuredPost->author }}</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-pcg-blue-900 mb-4 group-hover:text-pcg-blue-700 transition-colors duration-300">{{ $featuredPost->title }}</h2>
                        <p class="text-gray-700 text-lg mb-6 leading-relaxed">{{ $featuredPost->excerpt }}</p>
                        <a href="{{ route('news-update.show', $featuredPost->slug) }}" class="inline-flex items-center bg-gradient-to-r from-pcg-blue-600 to-pcg-blue-700 text-white px-8 py-4 rounded-full font-bold hover:from-pcg-blue-700 hover:to-pcg-blue-800 transition duration-300 shadow-lg hover:shadow-xl group">
                            Read Full Article
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </article>
        @endif
    </div>
</section>

<!-- Recent Posts -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-pcg-blue-900 mb-4">Recent Posts</h2>
            <div class="w-24 h-1 bg-pcg-blue-600 mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $blogImages = [
                'photo-1516450360452-9312f5e85d2d',
                'photo-1438232992991-995b7058bbb3',
                'photo-1529156069898-49953e39b3ac',
                'photo-1511632765486-a01980e01a18',
                'photo-1519741497674-611481863552',
                'photo-1464207687429-7505649dae38',
            ];
            $imageIndex = 0;
            @endphp
            
            @foreach($posts as $index => $post)
                @if($loop->index > 0)
                <article class="group cursor-pointer" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden h-full flex flex-col">
                        <div class="relative h-56 overflow-hidden">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" onerror="this.src='https://images.unsplash.com/{{ $blogImages[$imageIndex % count($blogImages)] }}?w=800&h=600&fit=crop'">
                            @else
                                <img src="https://images.unsplash.com/{{ $blogImages[$imageIndex % count($blogImages)] }}?w=800&h=600&fit=crop" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-white/90 backdrop-blur-sm text-pcg-blue-900 px-3 py-1 rounded-full text-xs font-bold">{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent' }}</span>
                            </div>
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-bold text-pcg-blue-900 mb-3 group-hover:text-pcg-blue-700 transition-colors duration-300">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-4 flex-1 line-clamp-3">{{ $post->excerpt }}</p>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>{{ $post->author }}</span>
                                </div>
                                <a href="{{ route('news-update.show', $post->slug) }}" class="inline-flex items-center text-pcg-blue-600 font-semibold hover:text-pcg-blue-700 transition-colors duration-300 group">
                                    Read More
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @php $imageIndex++; @endphp
                </article>
                @endif
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
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
    
    /* Line clamp utility */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush
