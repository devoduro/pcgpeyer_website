@extends('layouts.app')

@section('title', 'Our Leaders - PCG Monninger Congregation')

@section('content')
@php
    $isMinister = fn($leader) => str_contains(strtolower($leader->displayTitle ?? ''), 'minister');
@endphp

<!-- Hero -->
<section class="relative h-[50vh] min-h-[400px] flex items-center justify-center overflow-hidden bg-gradient-to-br from-pcg-blue-700 to-pcg-blue-900">
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-pcg-red-500 rounded-full filter blur-3xl"></div>
    </div>
    <div class="relative z-10 text-center text-white px-4" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Our Leaders</h1>
        <p class="text-xl md:text-2xl text-white/90">Serving God's people with Presbyterian faithfulness</p>
    </div>
</section>

<!-- Presbyterian Leadership Structure -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Presbyterian Leadership Structure</h2>
            <div class="w-20 h-0.5 bg-pcg-blue-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-4xl mx-auto">
                The Monninger Congregation follows the Presbyterian form of governance, with spiritual and administrative leadership provided by ordained ministers and elected elders serving on the Session.
            </p>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="bg-gradient-to-r from-pcg-blue-700 to-pcg-blue-900 text-white text-center p-8 rounded-2xl mb-12 shadow-lg" data-aos="zoom-in">
                <h3 class="text-2xl font-bold mb-2">The Session</h3>
                <p class="text-white/90">Minister-in-Charge &amp; Presbyters governing in Reformed tradition</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center group hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center bg-pcg-blue-100 group-hover:bg-pcg-blue-600 transition-colors duration-300">
                        <svg class="w-8 h-8 text-pcg-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Spiritual Leadership</h4>
                    <p class="font-medium mb-3 text-pcg-blue-600">Ministers</p>
                    <p class="text-gray-600 text-sm">Providing pastoral care, preaching, and spiritual guidance</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center group hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center bg-pcg-red-100 group-hover:bg-pcg-red-600 transition-colors duration-300">
                        <svg class="w-8 h-8 text-pcg-red-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7h-4V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2H4a1 1 0 00-1 1v3a2 2 0 002 2h14a2 2 0 002-2V8a1 1 0 00-1-1zM10 5h4v2h-4V5zm9 13a2 2 0 01-2 2H7a2 2 0 01-2-2v-6h14v6z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Administration</h4>
                    <p class="font-medium mb-3 text-pcg-red-600">Session Officers</p>
                    <p class="text-gray-600 text-sm">Managing church governance and communications</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 text-center group hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center bg-pcg-gold-100 group-hover:bg-pcg-gold-500 transition-colors duration-300">
                        <svg class="w-8 h-8 text-pcg-gold-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Ministry Oversight</h4>
                    <p class="font-medium mb-3 text-pcg-gold-600">Committee Chairs</p>
                    <p class="text-gray-600 text-sm">Leading evangelism, education, and member care</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search & Year Filter -->
<section class="py-8 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4">
            <div class="w-full">
                <div class="relative max-w-md mx-auto">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input
                        type="text"
                        id="leadershipSearch"
                        placeholder="Search by name or role..."
                        class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-pcg-blue-500 focus:border-pcg-blue-500 transition-all duration-200"
                        autocomplete="off">
                    <div id="searchResultCount" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-sm text-gray-500 hidden">
                        <span id="resultCount">0</span> results
                    </div>
                </div>
            </div>

            @if($yearMappings->count() > 1)
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('about.leadership') }}"
                       class="px-5 py-2 rounded-lg text-sm font-semibold transition {{ !$filterYear ? 'bg-pcg-blue-600 text-white shadow' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All Terms
                    </a>
                    @foreach($yearMappings as $mapping)
                        <a href="{{ route('about.leadership', ['year' => $mapping['year']]) }}"
                           class="px-5 py-2 rounded-lg text-sm font-semibold transition {{ $filterYear == $mapping['year'] ? 'bg-pcg-blue-600 text-white shadow' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $mapping['range'] }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Leadership Terms -->
@if($leadershipByYear->count())
    @foreach($leadershipByYear as $year => $leaders)
        @php
            $ministers = $leaders->filter($isMinister)->sortBy('display_order');
            $others = $leaders->reject($isMinister)->sortBy('display_order');
            $isCurrentTerm = $currentYear && $year === $currentYear;
        @endphp

        <!-- Ministers -->
        @if($ministers->count())
            <section class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <div class="inline-flex items-center gap-2 mb-3">
                            <h2 class="text-3xl font-bold text-gray-900">Ministers</h2>
                            @if($isCurrentTerm)
                                <span class="bg-pcg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">Current Term</span>
                            @endif
                        </div>
                        <p class="text-gray-600">{{ $year }} &middot; Our dedicated ministers who lead our congregation spiritually</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($ministers as $leader)
                            <div class="leadership-card group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:border-gray-200 transition-all duration-300"
                                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}"
                                 data-name="{{ strtolower($leader->name) }}"
                                 data-title="{{ strtolower($leader->displayTitle) }}">
                                <div class="relative h-64 overflow-hidden">
                                    @if($leader->image)
                                        <img src="{{ asset('storage/' . $leader->image) }}" alt="{{ $leader->name }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <img src="{{ asset('images/avatar-placeholder.png') }}" alt="{{ $leader->name }}"
                                             class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-pcg-blue-700 transition-colors duration-300">{{ $leader->name }}</h3>
                                    <p class="text-pcg-blue-600 font-medium mb-1">{{ $leader->displayTitle }}</p>
                                    @if($leader->bio)
                                        <p class="text-gray-700 text-sm leading-relaxed mt-3">{{ Str::limit($leader->bio, 150) }}</p>
                                    @endif
                                    @if($leader->email || $leader->phone)
                                        <div class="mt-4 pt-4 border-t border-gray-100 space-y-2">
                                            @if($leader->email)
                                                <a href="mailto:{{ $leader->email }}" class="flex items-center gap-2 text-sm text-gray-600 hover:text-pcg-blue-600 transition-colors">
                                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span class="truncate">{{ $leader->email }}</span>
                                                </a>
                                            @endif
                                            @if($leader->phone)
                                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                    </svg>
                                                    <span>{{ $leader->phone }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Presbyters & Officers -->
        @if($others->count())
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Church Presbyters</h2>
                        <p class="text-gray-600">Elected lay leaders serving our congregation ({{ $year }})</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 max-w-7xl mx-auto">
                        @foreach($others as $leader)
                            <div class="leadership-card group cursor-pointer"
                                 data-aos="fade-up" data-aos-delay="{{ ($loop->index % 5) * 75 }}"
                                 data-name="{{ strtolower($leader->name) }}"
                                 data-title="{{ strtolower($leader->displayTitle) }}">
                                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:border-pcg-blue-200 transition-all duration-300">
                                    <div class="relative h-48 overflow-hidden">
                                        @if($leader->image)
                                            <img src="{{ asset('storage/' . $leader->image) }}" alt="{{ $leader->name }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        @else
                                            <img src="{{ asset('images/avatar-placeholder.png') }}" alt="{{ $leader->name }}"
                                                 class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="p-3 text-center">
                                        <p class="font-semibold text-gray-900 text-sm leading-snug">{{ $leader->name }}</p>
                                        <p class="text-pcg-blue-600 text-xs font-medium mt-0.5">{{ $leader->displayTitle }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach
@else
    <section class="py-20 bg-white">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            @if($filterYear)
                <p class="text-gray-700 text-lg font-semibold mb-2">No leadership members found for this term</p>
                <a href="{{ route('about.leadership') }}" class="inline-block bg-pcg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-pcg-blue-700 transition">View All Terms</a>
            @else
                <p class="text-gray-600 text-lg">Leadership information will be available soon.</p>
            @endif
        </div>
    </section>
@endif

<!-- Contact Leadership CTA -->
<section class="py-16 bg-pcg-blue-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <h2 class="text-3xl font-bold mb-4">Contact Our Leadership Team</h2>
        <p class="text-xl mb-8 text-white/90 max-w-2xl mx-auto">Our church leaders are available to serve, pray with you, and answer any questions you may have.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="inline-block bg-white text-pcg-blue-800 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200">Contact Form</a>
            <a href="tel:+233557936254" class="inline-block bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-pcg-blue-800 transition-all duration-200">Call Church Office</a>
        </div>
    </div>
</section>

<script>
    // Search functionality
    const searchInput = document.getElementById('leadershipSearch');
    const searchResultCount = document.getElementById('searchResultCount');
    const resultCountSpan = document.getElementById('resultCount');

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.leadership-card');
            let visibleCount = 0;

            if (searchTerm === '') {
                cards.forEach(card => { card.style.display = ''; });
                searchResultCount.classList.add('hidden');
                return;
            }

            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                const title = card.getAttribute('data-title') || '';
                if (name.includes(searchTerm) || title.includes(searchTerm)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            resultCountSpan.textContent = visibleCount;
            searchResultCount.classList.remove('hidden');
        });
    }
</script>
@endsection
