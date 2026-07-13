<!-- News Updates Section -->
<section class="section-padding bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-700" onerror="this.src='https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=800&h=600&fit=crop'">
                        @else
                            <img src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=800&h=600&fit=crop" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-110 group-hover:rotate-2 transition-all duration-700">
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
            <!-- YAF Donation to VRA Presby School -->
            <div class="card overflow-hidden group flex flex-col" data-aos="fade-up" data-aos-delay="100">
                <div class="relative h-48 overflow-hidden flex-shrink-0">
                    <iframe 
                        src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fweb.facebook.com%2FDamcityTv%2Fvideos%2F995266299298362%2F&show_text=false&width=560&t=0" 
                        class="w-full h-full" 
                        style="border:none;overflow:hidden" 
                        scrolling="no" 
                        frameborder="0" 
                        allowfullscreen="true" 
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
                <div class="p-6 flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-pcg-red-100 text-pcg-red-600 text-xs font-bold px-3 py-1 rounded-full">YAF OUTREACH</span>
                        <span class="text-gray-500 text-sm">May 26, 2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-3">YAF Donates Stationery to VRA Presby School</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        The Young Adults' Fellowship (YAF) of the Presbyterian Church of Ghana, Monninger Congregation, Akosombo, 
                        led by its President Brother Stephen Addo and Fellowship Coordinator Mr Moses Teye Tetteh, District Minister 
                        and Resident Minister, Rev George Kwabi visited VRA Presby School to present stationery to final-year students.
                    </p>
                    <a href="https://web.facebook.com/DamcityTv/videos/995266299298362" target="_blank" class="text-pcg-red-600 font-semibold hover:text-pcg-red-700 inline-flex items-center">
                        Watch Video 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Ecumenical Visit to Muslim Community -->
            <div class="card overflow-hidden group flex flex-col" data-aos="fade-up" data-aos-delay="200">
                <div class="relative h-48 overflow-hidden flex-shrink-0">
                    <iframe 
                        src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fweb.facebook.com%2F100070341725574%2Fvideos%2F2488763854790787%2F&show_text=false&width=560&t=0" 
                        class="w-full h-full" 
                        style="border:none;overflow:hidden" 
                        scrolling="no" 
                        frameborder="0" 
                        allowfullscreen="true" 
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
                <div class="p-6 flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-pcg-blue-100 text-pcg-blue-600 text-xs font-bold px-3 py-1 rounded-full">ECUMENICAL</span>
                        <span class="text-gray-500 text-sm">2025</span>
                    </div>
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-3">Ecumenical Visit to Akosombo Muslim Community</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Our congregation participated in an ecumenical visit to the Akosombo Muslim Community, 
                        fostering interfaith dialogue and building bridges of understanding and peace in our community.
                    </p>
                    <a href="https://web.facebook.com/100070341725574/videos/2488763854790787" target="_blank" class="text-pcg-red-600 font-semibold hover:text-pcg-red-700 inline-flex items-center">
                        Watch Video 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Ewe Culture Through Food -->
            <div class="card overflow-hidden group flex flex-col" data-aos="fade-up" data-aos-delay="300">
                <div class="relative h-48 overflow-hidden flex-shrink-0">
                    <img src="https://img.youtube.com/vi/qsg6vwHZcDE/maxresdefault.jpg" alt="Ewe Culture Through Food" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="https://www.youtube.com/watch?v=qsg6vwHZcDE" target="_blank" class="w-16 h-16 bg-white rounded-full flex items-center justify-center hover:bg-pcg-red-600 hover:text-white transition">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="p-6 flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-green-100 text-green-600 text-xs font-bold px-3 py-1 rounded-full">CULTURAL</span>
                    </div>
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-3">Unlocking Ewe Culture Through Food</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Experience the rich traditions of Ewe culture through our celebration of Ghanaian delights. 
                        Discover the heritage and flavors that make our cultural celebrations special.
                    </p>
                    <a href="https://www.youtube.com/watch?v=qsg6vwHZcDE" target="_blank" class="text-pcg-red-600 font-semibold hover:text-pcg-red-700 inline-flex items-center">
                        Watch Video 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- COVID-19 Protocol Adherence -->
            <div class="card overflow-hidden group flex flex-col" data-aos="fade-up" data-aos-delay="400">
                <div class="relative h-48 overflow-hidden flex-shrink-0">
                    <img src="https://img.youtube.com/vi/bbT06TR1tlA/maxresdefault.jpg" alt="COVID-19 Protocol Adherence" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="https://www.youtube.com/watch?v=bbT06TR1tlA" target="_blank" class="w-16 h-16 bg-white rounded-full flex items-center justify-center hover:bg-pcg-red-600 hover:text-white transition">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="p-6 flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-purple-100 text-purple-600 text-xs font-bold px-3 py-1 rounded-full">HEALTH & SAFETY</span>
                    </div>
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-3">90% Score for COVID-19 Protocol Adherence</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Monninger Presby Church scored 90% at first service after the lifting of ban on churches. 
                        Damcity TV visited to fellowship and observe adherence to all government protocols. 
                        Kudos to Monninger Presby, Akosombo for outstanding performance!
                    </p>
                    <a href="https://www.youtube.com/watch?v=bbT06TR1tlA" target="_blank" class="text-pcg-red-600 font-semibold hover:text-pcg-red-700 inline-flex items-center">
                        Watch Video 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
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

