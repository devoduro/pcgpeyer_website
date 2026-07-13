<!-- Ministries Scrolling Section -->
<section class="section-padding bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="decorative-line"></div>
            <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-4">Our Ministries</h2>
            <p class="text-xl text-gray-600">Get involved and grow in faith</p>
        </div>

        <!-- Horizontal Scrolling Ministries -->
        <div class="overflow-x-auto pb-8 -mx-4 px-4">
            <div class="flex gap-6" style="width: max-content;">
                @foreach($featuredMinistries as $index => $ministry)
                <!-- {{ $ministry->name }} -->
                <div class="w-96 card overflow-hidden flex-shrink-0">
                    <div class="relative h-64">
                        <img src="{{ asset('storage/' . $ministry->image) }}" alt="{{ $ministry->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-6">
                          
                            <h3 class="text-2xl font-bold text-white">{{ $ministry->name }}</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 mb-4">{{ Str::limit($ministry->description, 100) }}</p>
                        @if($ministry->meeting_schedule)
                        <div class="flex items-center text-sm text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $ministry->meeting_schedule }}
                        </div>
                        @endif
                        <a href="{{ route('ministries.show', $ministry->slug) }}" class="text-pcg-red-600 font-semibold hover:text-pcg-red-700">Learn More →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('ministries.inter-generational') }}" class="btn-primary">View All Ministries</a>
        </div>
    </div>
</section>
