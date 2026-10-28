@extends('layouts.app')

@section('title', 'Inter-Generational Groups - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
@include('partials.page-hero', [
    'title' => 'Inter-Generational Groups',
    'eyebrow' => 'Ministries',
    'subtitle' => 'Bringing all ages together in worship, prayer and service.',
    'image' => 'images/bantama/choir.jpg',
    'crumbs' => [['Ministries', route('ministries.generational')], ['Inter-Generational Groups']],
])

<!-- Introduction -->
<section class="py-20 bg-white">
    <div class="site">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="decorative-line"></div>
            <h2 class="text-4xl md:text-5xl font-bold text-pcg-blue-900 mb-6">United Across Generations</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Our inter-generational ministries create opportunities for members of all ages to worship, serve, and grow together. 
                Experience the richness of multi-generational fellowship as we build God's kingdom together.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($ministries as $index => $ministry)
                @include('partials.ministry-card')
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
@include('partials.cta-band', [
    'eyebrow' => 'Get Involved',
    'title' => 'Get Involved Today',
    'text' => "Join one of our inter-generational ministries and experience the joy of serving together with believers of all ages. Everyone has a place in God's family.",
    'primary' => ['Contact Us Today', route('contact')],
    'secondary' => ['Generational Groups', route('ministries.generational')],
    'image' => 'images/bantama/choir.jpg',
])

<section class="py-24 bg-white" data-aos="fade-up">
    <div class="site">
        <div class="text-center mb-16">
            <div class="decorative-line"></div>
            <h2 class="section-title">PCG Age Groups</h2>
            <p class="section-subtitle">Discover ministries for every stage of life</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($generationalMinistries as $index => $ministry)
                @include('partials.ministry-card')
            @endforeach
        </div>
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
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush
