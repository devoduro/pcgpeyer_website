@extends('layouts.app')

@section('title', 'Group Leaders - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        <img src="{{ asset('images/church_building.png') }}" alt="Group Leadership" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-blue-800/90 to-pcg-blue-900/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="icon-circle-lg bg-white/20 backdrop-blur-lg border-2 border-white/30 mx-auto mb-8 animate-bounce-slow">
            <i class="fas fa-people-group text-3xl text-white"></i>
        </div>
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">Group Leaders</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">Meet our dedicated ministry leaders serving the congregation</p>
        <div class="w-24 h-1 bg-pcg-red-600 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<!-- Minister Leaders Grid -->
<section class="py-20 bg-gradient-to-b from-gray-50 via-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
            <div class="text-center py-16">
                <i class="fas fa-user-tie text-6xl text-gray-300 mb-4"></i>
                <p class="text-xl text-gray-600">No minister leaders available at this time.</p>
            </div>
        @endif
    </div>
</section>

<!-- Back to About -->
<section class="py-8 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('about.leadership') }}" class="inline-flex items-center gap-2 text-pcg-blue-600 hover:text-pcg-blue-800 font-semibold transition-colors">
            <i class="fas fa-arrow-left"></i> Back to Leadership
        </a>
    </div>
</section>
@endsection
