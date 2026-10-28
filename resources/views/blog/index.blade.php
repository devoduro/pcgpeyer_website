@extends('layouts.app')

@section('title', 'News Update - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
@include('partials.page-hero', [
    'title' => 'News Update',
    'eyebrow' => 'Latest from Bantama',
    'subtitle' => 'News, updates and inspiration from the life of our congregation.',
    'image' => 'images/bantama/yaf.jpg',
    'crumbs' => [['News Update']],
])

<!-- Featured Post -->
<section class="py-12 bg-white">
    <div class="site">
        @if($posts->isNotEmpty())
        @php $featuredPost = $posts->first(); @endphp
        <article class="group cursor-pointer" data-aos="fade-up">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                    <div class="relative h-96 lg:h-auto overflow-hidden">
                        @if($featuredPost->image)
                            <img src="{{ asset('storage/' . $featuredPost->image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" onerror="this.src='{{ asset('images/bantama/womens_fellowship.jpg') }}'">
                        @else
                            <img src="{{ asset('images/bantama/womens_fellowship.jpg') }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
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

@if($posts->count() > 1)
<!-- Recent Posts -->
<section class="py-20 bg-gray-50">
    <div class="site">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-pcg-blue-900 mb-4">Recent Posts</h2>
            <div class="w-24 h-1 bg-pcg-blue-600 mx-auto"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $blogImages = [
                asset('images/bantama/womens_fellowship.jpg'),
                asset('images/bantama/choir.jpg'),
                asset('images/bantama/yaf.jpg'),
                asset('images/bantama/ypg.jpg'),
                asset('images/bantama/mens_fellowship.jpg'),
                asset('images/bantama/brigade_b.jpg'),
            ];
            $imageIndex = 0;
            @endphp
            
            @foreach($posts as $index => $post)
                @if($loop->index > 0)
                <article class="group cursor-pointer" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden h-full flex flex-col">
                        <div class="relative h-56 overflow-hidden">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" onerror="this.src='{{ $blogImages[$imageIndex % count($blogImages)] }}'">
                            @else
                                <img src="{{ $blogImages[$imageIndex % count($blogImages)] }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
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
@endif
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
