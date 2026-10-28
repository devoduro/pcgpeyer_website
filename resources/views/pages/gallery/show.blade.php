@extends('layouts.app')

@section('title', $gallery->title . ' - Photo Gallery')

@section('content')
<!-- Hero Section -->
@include('partials.page-hero', [
    'title' => $gallery->title,
    'eyebrow' => 'Photo Gallery',
    'subtitle' => $gallery->description,
    'image' => $gallery->thumbnail_path ? asset('storage/' . $gallery->thumbnail_path) : 'images/bantama/womens_fellowship.jpg',
    'crumbs' => [['Galleries', route('gallery.index')], [Str::limit($gallery->title, 40)]],
    'meta' => [['fas fa-images', $gallery->images->count() . ' ' . Str::plural('photo', $gallery->images->count())], ['far fa-calendar', $gallery->created_at->format('M d, Y')]],
])

<!-- Gallery Images -->
<section class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="site">
        @if($gallery->images->count() > 0)
            <!-- Masonry Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($gallery->images as $index => $image)
                    <div class="gallery-item relative group cursor-pointer overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 {{ $index % 7 == 0 ? 'row-span-2' : '' }}"
                         data-aos="fade-up" 
                         data-aos-delay="{{ ($index % 12) * 50 }}"
                         onclick="openLightbox({{ $index }})">
                        
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             alt="{{ $image->caption ?? $gallery->title }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                             loading="lazy">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        
                        <!-- Caption -->
                        @if($image->caption)
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                                <p class="text-sm font-semibold">{{ $image->caption }}</p>
                            </div>
                        @endif
                        
                        <!-- Zoom Icon -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform scale-0 group-hover:scale-100">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <i class="fas fa-images text-8xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-4">No Photos Yet</h3>
                <p class="text-gray-500 text-lg">This gallery doesn't have any photos at the moment.</p>
            </div>
        @endif
    </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden items-center justify-center p-4">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition z-10">
        <i class="fas fa-times"></i>
    </button>
    
    <button onclick="previousImage()" class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition z-10">
        <i class="fas fa-chevron-left"></i>
    </button>
    
    <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl hover:text-gray-300 transition z-10">
        <i class="fas fa-chevron-right"></i>
    </button>
    
    <div class="max-w-6xl max-h-full flex flex-col items-center">
        <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
        <div id="lightbox-caption" class="text-white text-center mt-4 text-lg"></div>
        <div class="text-gray-400 text-sm mt-2">
            <span id="lightbox-counter"></span>
        </div>
    </div>
</div>

<script>
const images = @json($gallery->images->map(function($image) {
    return [
        'url' => asset('storage/' . $image->image_path),
        'caption' => $image->caption ?? ''
    ];
}));

let currentImageIndex = 0;

function openLightbox(index) {
    currentImageIndex = index;
    showImage();
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function showImage() {
    const image = images[currentImageIndex];
    document.getElementById('lightbox-image').src = image.url;
    document.getElementById('lightbox-caption').textContent = image.caption;
    document.getElementById('lightbox-counter').textContent = `${currentImageIndex + 1} / ${images.length}`;
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    showImage();
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    showImage();
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (!document.getElementById('lightbox').classList.contains('hidden')) {
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') previousImage();
        if (e.key === 'Escape') closeLightbox();
    }
});

// Close on background click
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) closeLightbox();
});
</script>

<style>
    .row-span-2 {
        grid-row: span 2;
    }
    
    @media (max-width: 768px) {
        .row-span-2 {
            grid-row: span 1;
        }
    }
</style>
@endsection
