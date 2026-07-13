<!-- Photo Gallery Section -->
<section class="py-24 bg-white relative overflow-hidden">
    <!-- Elegant Background Pattern -->
    <div class="absolute inset-0 opacity-[0.02]" ></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
       
          <div class="text-center mb-16">
            <div class="decorative-line"></div>
            <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-4"> Our Gallery</h2>
            <p class="text-xl text-gray-600"> Witness the beauty of our faith community through these cherished memories</p>
        </div>
       
     
        @if(isset($latestGalleries) && $latestGalleries->count() > 0)
        <!-- Elegant Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $heights = ['h-64', 'h-80', 'h-72', 'h-64', 'h-72', 'h-80', 'h-64', 'h-72'];
            @endphp
            
            @foreach($latestGalleries as $index => $gallery)
                <a href="{{ route('gallery.show', $gallery->id) }}" 
                   class="gallery-card group block bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-700 transform hover:-translate-y-2"
                   data-aos="fade-up" 
                   data-aos-delay="{{ ($index + 1) * 100 }}">
                    
                    <!-- Image Container -->
                    <div class="relative h-80 overflow-hidden bg-gray-100">
                        @if($gallery->thumbnail_path)
                            <img src="{{ asset('storage/' . $gallery->thumbnail_path) }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-1000 ease-out"
                                 loading="lazy"
                                 onerror="this.src='https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=800&h=600&fit=crop'">
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
        @else
        <!-- Fallback content when no galleries exist -->
        <div class="text-center py-12">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500 text-lg">No galleries available at the moment.</p>
            <p class="text-gray-400 text-sm mt-2">Check back soon for new photo collections!</p>
        </div>
        @endif

        <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="300">
           
              <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="500">
            <a href="{{ route('media.photos') }}"  class="btn-primary">Explore All Galleries</a>
        </div>
           
        </div>
    </div>
</section>
