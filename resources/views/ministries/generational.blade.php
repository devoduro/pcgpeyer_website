@extends('layouts.app')

@section('title', 'Generational Groups - PCG Monninger Congregation')

@section('content')
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300?w=1920&h=600&fit=crop" alt="Generational Groups" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-pcg-blue-900/95 via-pcg-blue-800/90 to-pcg-blue-700/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">Generational Ministries</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">Ministries Tailored for Every Stage of Life</p>
        <div class="w-24 h-1 bg-blue-400 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<!-- Introduction -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="decorative-line"></div>
            <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">A Ministry for Every Generation</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                From children to seniors, we provide age-appropriate ministries that nurture spiritual growth, 
                build community, and equip believers to live out their faith at every stage of life.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ministries as $index => $ministry)
            <!-- {{ $ministry->name }} -->
            <div class="group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 hover:-translate-y-3">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $ministry->image) }}" alt="{{ $ministry->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-{{ $index % 2 == 0 ? 'pcg-blue' : 'pcg-red' }}-900/90 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                         
                            <h3 class="text-2xl font-bold text-white mb-1">{{ $ministry->name }}</h3>
                            @if($ministry->age_range)
                                <p class="text-{{ $index % 2 == 0 ? 'blue' : 'red' }}-100 text-sm">{{ $ministry->age_range }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        @if($ministry->ministry_category)
                            <span class="inline-block bg-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-100 text-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-800 px-3 py-1 rounded-full text-xs font-bold mb-3">
                                {{ $ministry->ministry_category }}
                            </span>
                        @endif
                        <p class="text-gray-700 mb-4 leading-relaxed">{{ $ministry->description }}</p>
                          @if($ministry->meeting_schedule)
                            <div class="flex items-center text-gray-600 bg-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 mr-3 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span><strong>Meeting Day & Time:</strong> {{ $ministry->meeting_schedule }}</span>
                            </div>
                            @endif
                             @if($ministry->location)
                            <div class="flex items-center text-gray-600 bg-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 mr-3 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <span><strong>Location:</strong> {{ $ministry->location }}</span>
                            </div>
                            @endif
                        <div class="space-y-2 mb-4">
                            @if($ministry->leader)
                            <div class="flex items-center text-gray-600 bg-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 mr-3 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span><strong>Leader:</strong> {{ $ministry->leader }}</span>
                            </div>
                            @endif
                            @if($ministry->leader_phone)
                            <div class="flex items-center text-gray-600 bg-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-50 p-3 rounded-lg">
                                <svg class="w-5 h-5 mr-3 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span><strong>Phone:</strong> {{ $ministry->leader_phone }}</span>
                            </div>
                            @endif
                         
                           
                        </div>
                        <a href="{{ route('ministries.show', $ministry->slug) }}" class="inline-block bg-gradient-to-r from-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-600 to-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-700 text-white px-6 py-3 rounded-full font-semibold hover:from-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-700 hover:to-pcg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-800 transition duration-300 shadow-lg hover:shadow-xl">Learn More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-br from-pcg-blue-900 to-pcg-red-900 text-white relative overflow-hidden" data-aos="fade-up">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-pcg-red-500 rounded-full filter blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="icon-circle-lg bg-white/20 backdrop-blur-lg border-2 border-white/30 mx-auto mb-8" data-aos="zoom-in">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold mb-6" data-aos="fade-up" data-aos-delay="100">Find Your Place</h2>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            No matter your age or stage of life, there's a ministry waiting for you. Join us and experience 
            the joy of growing in faith with others who share your journey.
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-white text-pcg-blue-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition duration-300 shadow-2xl hover:shadow-3xl hover:scale-105" data-aos="zoom-in" data-aos-delay="300">Get Connected</a>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Custom animations */
    @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    @keyframes expand {
        from {
            width: 0;
        }
        to {
            width: 6rem;
        }
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    .animate-expand {
        animation: expand 1s ease-out forwards;
    }
</style>
@endpush
