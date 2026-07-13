@extends('layouts.app')

@section('title', $groupLeadership->name . ' - PCG Monninger Congregation')

@section('content')
<!-- Hero Header -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        @if($groupLeadership->image)
            <img src="{{ asset('storage/' . $groupLeadership->image) }}" alt="{{ $groupLeadership->name }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/60 to-black/70"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900 via-pcg-blue-800 to-pcg-blue-900"></div>
        @endif
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="icon-circle-lg bg-white/20 backdrop-blur-lg border-2 border-white/30 mx-auto mb-8 animate-bounce-slow">
            <i class="fas fa-people-group text-3xl text-white"></i>
        </div>
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">{{ $groupLeadership->name }}</h1>
        <div class="w-24 h-1 bg-pcg-red-600 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<!-- Group Details -->
<section class="py-20 bg-gradient-to-b from-gray-50 via-white to-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Description Card -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-12" data-aos="fade-up">
            @if($groupLeadership->description)
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-wrap">{{ $groupLeadership->description }}</p>
                </div>
            @else
                <p class="text-gray-600 text-center py-8">No additional information available.</p>
            @endif
        </div>

        <!-- Call to Action -->
        <div class="bg-gradient-to-r from-pcg-blue-600 to-pcg-red-600 rounded-2xl shadow-lg p-8 text-center text-white" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-4">Get Involved</h2>
            <p class="mb-6">Want to join this group? Contact us for more information about membership and participation.</p>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 bg-white text-pcg-blue-600 px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                <i class="fas fa-envelope"></i> Contact Us
            </a>
        </div>
    </div>
</section>

<!-- Navigation -->
<section class="py-8 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <a href="{{ route('group-leadership.index') }}" class="inline-flex items-center gap-2 text-pcg-blue-600 hover:text-pcg-blue-800 font-semibold transition-colors">
            <i class="fas fa-arrow-left"></i> Back to Groups
        </a>
        <a href="{{ route('about.leadership') }}" class="inline-flex items-center gap-2 text-pcg-blue-600 hover:text-pcg-blue-800 font-semibold transition-colors">
            Back to Leadership <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>
@endsection
