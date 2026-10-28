@extends('layouts.app')

@section('title', 'Past Leaders - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero -->
@include('partials.page-hero', [
    'title' => 'Past Leaders',
    'eyebrow' => 'Our Leadership Legacy',
    'subtitle' => 'Honouring the ministers, catechists and presbyters who have faithfully served Peyer Memorial Congregation' . ($stats['earliest_year'] ? ' since ' . $stats['earliest_year'] : '') . '.',
    'image' => 'images/bantama/choir.jpg',
    'crumbs' => [['About Us', route('about.history')], ['Past Leaders']],
])

<!-- Our Leadership Legacy -->
<section class="py-16 bg-gray-50">
    <div class="site">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Leadership Legacy</h2>
            <div class="w-20 h-0.5 bg-pcg-blue-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600 max-w-4xl mx-auto mb-8">
                Since our establishment in 1958, Peyer Memorial Congregation has been blessed with dedicated ministers, catechists, and presbyters who have guided our church through seasons of growth. From a Morning Devotion group to being renamed in honour of Rev. Ernst Peyer in 1990, their faithful service has shaped our Presbyterian identity and mission in Bantama, Kumasi.
            </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto">
                <div class="bg-white p-6 rounded-[18px] shadow-card card-hover">
                    <div class="text-3xl font-bold text-pcg-blue-600 mb-2 tabular-nums" data-count-to="{{ $stats['years_of_history'] }}" data-count-suffix="+">{{ $stats['years_of_history'] }}+</div>
                    <div class="text-gray-700">Years of History</div>
                </div>
                <div class="bg-white p-6 rounded-[18px] shadow-card card-hover">
                    <div class="text-3xl font-bold text-pcg-blue-600 mb-2 tabular-nums" data-count-to="{{ $stats['ministers_in_charge'] }}">{{ $stats['ministers_in_charge'] }}</div>
                    <div class="text-gray-700">Ministers-in-Charge</div>
                </div>
                <div class="bg-white p-6 rounded-[18px] shadow-card card-hover">
                    <div class="text-3xl font-bold text-pcg-blue-600 mb-2 tabular-nums" data-count-to="{{ $stats['catechists'] }}">{{ $stats['catechists'] }}</div>
                    <div class="text-gray-700">Catechists</div>
                </div>
                <div class="bg-white p-6 rounded-[18px] shadow-card card-hover">
                    <div class="text-3xl font-bold text-pcg-blue-600 mb-2 tabular-nums" data-count-to="{{ $stats['session_terms'] }}">{{ $stats['session_terms'] }}</div>
                    <div class="text-gray-700">Session Terms</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Past Leaders -->
<section class="py-16 bg-white">
    <div class="site">
        <div class="text-center mb-10" data-aos="fade-up">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $activeCategory ?: 'All Past Leaders' }}</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">Each leader brought unique gifts and vision to the spiritual growth and development of Peyer Memorial Congregation.</p>
        </div>

        {{-- Search and filter. Plain GET form, so results can be bookmarked and shared. --}}
        <form method="GET" action="{{ route('about.ministers') }}" role="search" class="card p-4 md:p-5 mb-6 max-w-4xl mx-auto" data-aos="fade-up">
            @if($activeCategory)
                <input type="hidden" name="category" value="{{ $activeCategory }}">
            @endif
            <div class="grid gap-3 md:grid-cols-[1fr_200px_auto] items-end">
                <div>
                    <label for="leader-search" class="label">Search</label>
                    <div class="relative">
                        <i class="fas fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-ink-400 text-sm"></i>
                        <input id="leader-search" type="search" name="q" value="{{ $search }}" placeholder="Name, role, hometown or a year (e.g. 1990)" class="input pl-10">
                    </div>
                </div>
                <div>
                    <label for="leader-decade" class="label">Served in</label>
                    <select id="leader-decade" name="decade" class="input" onchange="this.form.requestSubmit()">
                        <option value="">Any time</option>
                        @foreach($decades as $d)
                            <option value="{{ $d }}" @selected($decade === $d)>{{ $d }}s</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary"><i class="fas fa-magnifying-glass"></i> Search</button>
                    @if($filters)
                        <a href="{{ route('about.ministers', array_filter(['category' => $activeCategory])) }}" class="btn-outline">Clear</a>
                    @endif
                </div>
            </div>
        </form>

        <div class="flex justify-center mb-6" data-aos="fade-up">
            <div class="inline-flex flex-wrap justify-center rounded-xl bg-ink-100 p-1 gap-1">
                <a href="{{ route('about.ministers', $filters) }}"
                   class="px-4 py-2 md:px-5 md:py-2.5 rounded-lg font-semibold transition-all duration-200 text-sm md:text-[15px] whitespace-nowrap {{ !$activeCategory ? 'bg-white text-brand-700 shadow-sm' : 'text-ink-600 hover:text-ink-900' }}">
                    All <span class="ml-1 text-xs text-ink-400">{{ $matching->count() }}</span>
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('about.ministers', ['category' => $category] + $filters) }}"
                       class="px-4 py-2 md:px-5 md:py-2.5 rounded-lg font-semibold transition-all duration-200 text-sm md:text-[15px] whitespace-nowrap {{ $activeCategory === $category ? 'bg-white text-brand-700 shadow-sm' : 'text-ink-600 hover:text-ink-900' }}">
                        {{ $category }} <span class="ml-1 text-xs text-ink-400">{{ $categoryCounts[$category] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        @if($filters)
            <p class="text-center text-sm text-ink-500 mb-10" aria-live="polite">
                {{ $filteredMinisters->count() }} {{ Str::plural('leader', $filteredMinisters->count()) }}
                @if($search !== '') matching &ldquo;<strong class="text-ink-800">{{ $search }}</strong>&rdquo; @endif
                @if($decade) who served in the <strong class="text-ink-800">{{ $decade }}s</strong> @endif
                @if($activeCategory) under {{ $activeCategory }} @endif
            </p>
        @else
            <div class="mb-10"></div>
        @endif

        @if($filteredMinisters->count())
            @if($termGroups)
                {{-- Presbyter Sessions: one block per term, newest first. --}}
                <div class="space-y-12">
                    @foreach($termGroups as $term => $leaders)
                        <div data-aos="fade-up">
                            <div class="flex items-center gap-4 mb-6">
                                <h3 class="text-2xl font-extrabold text-ink-900 shrink-0">{{ $term }}</h3>
                                <span class="badge badge-brand shrink-0">{{ $leaders->count() }} {{ Str::plural('officer', $leaders->count()) }}</span>
                                <span class="h-px flex-1 bg-ink-200"></span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($leaders as $minister)
                                    @include('about.partials.leader-card')
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($filteredMinisters as $minister)
                        @include('about.partials.leader-card')
                    @endforeach
                </div>
            @endif
        @else
            <div class="max-w-2xl mx-auto text-center py-12" data-aos="fade-up">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <p class="text-gray-600 text-lg">
                    @if($filters)
                        No past leaders match your search.
                        <a href="{{ route('about.ministers', array_filter(['category' => $activeCategory])) }}" class="block mt-4 text-brand-600 font-semibold hover:text-accent-600">Clear search and filters</a>
                    @elseif($activeCategory)
                        No past leaders recorded yet under "{{ $activeCategory }}".
                    @else
                        Past leader records will appear here once added from the dashboard.
                    @endif
                </p>
            </div>
        @endif
    </div>
</section>

<!-- Current Leadership CTA -->
@include('partials.cta-band', [
    'eyebrow' => 'Thus Far the Lord Has Helped Us',
    'title' => 'Continue the Legacy',
    'text' => 'Join us as we continue building on the foundation laid by these faithful leaders.',
    'primary' => ['Get Involved', route('contact')],
    'secondary' => ['Current Leadership', route('about.leadership')],
    'image' => 'images/bantama/mens_fellowship.jpg',
])

<!-- Continue the Legacy -->
<section class="py-16 bg-pcg-blue-800 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <h2 class="text-3xl font-bold mb-4">Continue the Legacy</h2>
        <p class="text-xl mb-8 text-white/90 max-w-2xl mx-auto">Join us as we continue building on the foundation laid by these faithful leaders.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('about.leadership') }}" class="inline-block bg-white text-pcg-blue-800 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200">Current Leadership</a>
            <a href="{{ route('contact') }}" class="inline-block bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-pcg-blue-800 transition-all duration-200">Get Involved</a>
        </div>
    </div>
</section>
@endsection
