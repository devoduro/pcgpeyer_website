@if($announcements->count())
<!-- Announcements Section -->
<section class="section-padding bg-gradient-to-b from-pcg-blue-50 to-white">
    <div class="site">
        <div class="text-center mb-12" data-aos="fade-up">
            <div class="inline-block">
                <span class="text-pcg-red-600 font-semibold text-sm uppercase tracking-wider mb-2 block">Stay Informed</span>
                <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-4">Announcements</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-pcg-blue-600 to-pcg-red-600 mx-auto"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
            @foreach($announcements as $announcement)
                @php
                    $styles = [
                        'urgent' => ['border' => 'border-pcg-red-500', 'badge' => 'bg-pcg-red-100 text-pcg-red-700', 'icon' => 'text-pcg-red-600', 'label' => 'Urgent'],
                        'event' => ['border' => 'border-purple-500', 'badge' => 'bg-purple-100 text-purple-700', 'icon' => 'text-purple-600', 'label' => 'Event'],
                        'info' => ['border' => 'border-pcg-blue-500', 'badge' => 'bg-pcg-blue-100 text-pcg-blue-700', 'icon' => 'text-pcg-blue-600', 'label' => 'Announcement'],
                    ];
                    $style = $styles[$announcement->type] ?? $styles['info'];
                @endphp
                <div class="relative bg-white rounded-2xl shadow-lg border-l-4 {{ $style['border'] }} p-6 hover:shadow-xl transition-shadow duration-300" data-aos="fade-up">
                    @if($announcement->pinned)
                        <div class="absolute top-4 right-4 {{ $style['icon'] }}" title="Pinned">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M11 2a1 1 0 00-1 1v6.586L7.293 12.293a1 1 0 000 1.414L9 15.414V18a1 1 0 102 0v-2.586l1.707-1.707a1 1 0 000-1.414L10 9.586V3a1 1 0 00-1-1z"/></svg>
                        </div>
                    @endif
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $style['badge'] }}">{{ $style['label'] }}</span>
                        <span class="text-gray-400 text-xs">{{ $announcement->created_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-pcg-blue-900 mb-2">{{ $announcement->title }}</h3>
                    <p class="text-gray-700 leading-relaxed mb-4">{{ $announcement->message }}</p>
                    @if($announcement->link_url)
                        <a href="{{ $announcement->link_url }}" target="_blank" class="inline-flex items-center text-pcg-red-600 font-semibold hover:text-pcg-blue-900 transition-colors duration-300">
                            {{ $announcement->link_text ?: 'Learn More' }}
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
