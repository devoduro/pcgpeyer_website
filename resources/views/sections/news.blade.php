<!-- News Updates Section -->
<section class="section-padding bg-gradient-to-b from-gray-50 to-white">
    <div class="site">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-block">
                <span class="text-pcg-red-600 font-semibold text-sm uppercase tracking-wider mb-2 block">Latest Updates</span>
                <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-4">News Updates</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-pcg-blue-600 to-pcg-red-600 mx-auto"></div>
            </div>
            <p class="text-xl text-gray-600 mt-4">Stay connected with our community</p>
        </div>

        <!-- News Grid Container -->
        <div class="relative">
            <!-- News Grid - Shows 4 items -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @if(isset($latestPosts) && $latestPosts->count() > 0)
                @foreach($latestPosts as $index => $post)
                <div class="news-card bg-white rounded-2xl overflow-hidden group flex flex-col shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100" data-index="{{ $index }}">
                    <div class="relative h-56 overflow-hidden flex-shrink-0">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-700" onerror="this.src='{{ asset('images/bantama/members_group.jpg') }}'">
                        @else
                            <img src="{{ asset('images/bantama/members_group.jpg') }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-700">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <div class="absolute top-4 right-4">
                            <div class="bg-pcg-red-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg backdrop-blur-sm">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent' }}
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-pcg-blue-900 mb-3 line-clamp-2 group-hover:text-pcg-red-600 transition-colors duration-300">
                            {{ $post->title }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-4 line-clamp-3 flex-grow">
                            {{ $post->excerpt }}
                        </p>
                        <a href="{{ route('news-update.show', $post->slug) }}" class="inline-flex items-center text-pcg-red-600 font-semibold hover:text-pcg-blue-900 transition-colors duration-300 group/link">
                            Read Full Story
                            <svg class="w-4 h-4 ml-2 transform group-hover/link:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            @else
            <div class="col-span-full text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6v4H7v-4z"/>
                </svg>
                <p class="text-gray-500 text-lg">No news updates yet. Check back soon!</p>
            </div>
            @endif
            </div>
        </div>

        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="500">
            <a href="{{ route('news-update') }}" class="btn-primary">View All News</a>
        </div>
    </div>
</section>

<style>
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

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    @media (max-width: 768px) {
        #newsScroller .card {
            min-width: 280px;
            max-width: 280px;
        }
    }
</style>

