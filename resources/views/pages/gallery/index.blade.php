@extends('layouts.app')

@section('title', 'Photo Gallery - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Section -->
@include('partials.page-hero', [
    'title' => 'Photo Galleries',
    'eyebrow' => 'Media',
    'subtitle' => 'Albums from services, celebrations and the life of the congregation.',
    'image' => 'images/bantama/womens_fellowship.jpg',
    'crumbs' => [['Media', route('media.photos')], ['Galleries']],
])

<!-- Galleries Grid -->
<section class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="site">
        @if($galleries->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galleries as $gallery)
                    <a href="{{ route('gallery.show', $gallery->id) }}" 
                       class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                       data-aos="fade-up" 
                       data-aos-delay="{{ $loop->index * 100 }}">
                        
                        <!-- Gallery Thumbnail -->
                        <div class="relative h-64 overflow-hidden">
                            @if($gallery->thumbnail_path)
                                <img src="{{ asset('storage/' . $gallery->thumbnail_path) }}" 
                                     alt="{{ $gallery->title }}" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-pcg-blue-400 to-pcg-red-400 flex items-center justify-center">
                                    <i class="fas fa-images text-8xl text-white opacity-30"></i>
                                </div>
                            @endif
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                            
                            <!-- View Icon -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform scale-0 group-hover:scale-100">
                                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <i class="fas fa-eye text-white text-2xl"></i>
                                </div>
                            </div>
                            
                            <!-- Photo Count Badge -->
                            @if($gallery->images && $gallery->images->count() > 0)
                                <div class="absolute top-4 right-4 bg-pcg-red-600 text-white px-4 py-2 rounded-full shadow-lg backdrop-blur-sm font-bold">
                                    <i class="fas fa-images mr-2"></i>{{ $gallery->images->count() }}
                                </div>
                            @endif
                        </div>
                        
                        <!-- Gallery Info -->
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-pcg-blue-900 mb-3 group-hover:text-pcg-red-600 transition-colors duration-300">
                                {{ $gallery->title }}
                            </h3>
                            @if($gallery->description)
                                <p class="text-gray-600 leading-relaxed mb-4 line-clamp-3">
                                    {{ $gallery->description }}
                                </p>
                            @endif
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>
                                    <i class="far fa-calendar mr-2"></i>
                                    {{ $gallery->created_at->format('M d, Y') }}
                                </span>
                                <span class="text-pcg-red-600 font-semibold group-hover:translate-x-2 transition-transform duration-300 inline-flex items-center">
                                    View Gallery
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($galleries->hasPages())
                <div class="mt-12">
                    {{ $galleries->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <i class="fas fa-images text-8xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-4">No Galleries Yet</h3>
                <p class="text-gray-500 text-lg">Check back soon for photo galleries from our church events and activities.</p>
            </div>
        @endif
    </div>
</section>

<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
