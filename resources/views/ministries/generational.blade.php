@extends('layouts.app')

@section('title', 'Generational Groups - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
@include('partials.page-hero', [
    'title' => 'Generational Groups',
    'eyebrow' => 'Ministries',
    'subtitle' => "From Children's Service to the Men's and Women's Fellowships, a group for every stage of life.",
    'image' => 'images/bantama/jy_sunday.jpg',
    'crumbs' => [['Ministries', route('ministries.generational')], ['Generational Groups']],
])

<!-- Introduction -->
<section class="py-20 bg-white">
    <div class="site">
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
                @include('partials.ministry-card')
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
@include('partials.cta-band', [
    'eyebrow' => 'Get Involved',
    'title' => 'Find Your Place',
    'text' => "No matter your age or stage of life, there's a ministry waiting for you. Join us and grow in faith with others who share your journey.",
    'primary' => ['Get Connected', route('contact')],
    'secondary' => ['Inter-Generational Groups', route('ministries.inter-generational')],
    'image' => 'images/bantama/children_worship.jpg',
])
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
