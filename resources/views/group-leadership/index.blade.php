@extends('layouts.app')

@section('title', 'Group Leaders - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
@include('partials.page-hero', [
    'title' => 'Group Leaders',
    'eyebrow' => 'About Us',
    'subtitle' => 'Meet the leaders of our fellowships, guilds and singing groups.',
    'image' => 'images/bantama/trad_sunday.jpg',
    'crumbs' => [['About Us', route('about.history')], ['Group Leaders']],
])

<!-- Minister Leaders Grid -->
<section class="py-20 bg-gradient-to-b from-gray-50 via-white to-gray-50">
    <div class="site">
        @if($ministers->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($ministers as $minister)
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 overflow-hidden border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <!-- Leader Picture Section -->
                        <div class="relative h-80 overflow-hidden bg-gradient-to-br from-pcg-blue-400 to-pcg-red-400">
                            @if($minister->leader_picture)
                                <img src="{{ asset('storage/' . $minister->leader_picture) }}" alt="{{ $minister->leader }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-white">
                                    <i class="fas fa-user-tie text-6xl opacity-30"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            
                            <!-- Ministry Name Badge -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="bg-white/95 backdrop-blur-sm rounded-lg px-4 py-2 shadow-lg">
                                           <h4 class="text-sm font-bold text-gray-900">{{ $minister->name }}</h4>
                                 <p class="text-xs text-gray-600 font-medium uppercase tracking-wide">Leader</p>
                           
                                        </div>
                            </div>
                        </div>

                        <!-- Leader Info Section -->
                        <div class="p-6">
                            <!-- Leader Name -->
                            <div class="mb-4">
                                <h3 class="text-2xl font-bold text-gray-900 mb-1 group-hover:text-pcg-blue-700 transition-colors">{{ $minister->leader }}</h3>
                                <p class="text-sm text-pcg-blue-600 font-semibold">Ministry Leader</p>
                            </div>
                            
                            <!-- Contact Info -->
                            <div class="space-y-3 mb-6">
                                @if($minister->leader_phone)
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <div class="flex items-center justify-center w-8 h-8 bg-pcg-blue-100 rounded-lg">
                                            <i class="fas fa-phone text-pcg-blue-600 text-sm"></i>
                                        </div>
                                        <a href="tel:{{ $minister->leader_phone }}" class="text-sm hover:text-pcg-blue-600 transition-colors">{{ $minister->leader_phone }}</a>
                                    </div>
                                @endif
                                
                                @if($minister->contact_email)
                                    <div class="flex items-center gap-3 text-gray-600">
                                        <div class="flex items-center justify-center w-8 h-8 bg-pcg-red-100 rounded-lg">
                                            <i class="fas fa-envelope text-pcg-red-600 text-sm"></i>
                                        </div>
                                        <a href="mailto:{{ $minister->contact_email }}" class="text-sm hover:text-pcg-red-600 transition-colors truncate">{{ $minister->contact_email }}</a>
                                    </div>
                                @endif
                            </div>

                            <!-- View Ministry Details Button -->
                            <a href="{{ route('ministries.show', $minister) }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-pcg-blue-600 to-pcg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300 group-hover:gap-3 w-full justify-center">
                                View Ministry
                                <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Until this year's group leaders are entered, show the groups themselves. --}}
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                <span class="eyebrow">Our Groups</span>
                <h2 class="section-title mt-2">Fellowships &amp; Guilds</h2>
                <p class="text-ink-500">This year's group leaders will be listed here soon. In the meantime, here is when and where each group meets. Everyone is welcome.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($groups as $ministry)
                    @include('partials.ministry-card')
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Back to About -->
<section class="py-8 bg-gray-50 border-t border-gray-200">
    <div class="site">
        <a href="{{ route('about.leadership') }}" class="inline-flex items-center gap-2 text-pcg-blue-600 hover:text-pcg-blue-800 font-semibold transition-colors">
            <i class="fas fa-arrow-left"></i> Back to Leadership
        </a>
    </div>
</section>
@endsection
