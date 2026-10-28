@extends('layouts.app')

@section('title', $ministry->name . ' - PCG Peyer Memorial')

@section('content')
<!-- Hero Section -->
@include('partials.page-hero', [
    'title' => $ministry->name,
    'eyebrow' => $ministry->ministry_category ?: 'Ministries',
    'subtitle' => $ministry->description,
    'image' => $ministry->image_url,
    'crumbs' => [['Ministries', route('ministries.generational')], [$ministry->name]],
    'meta' => array_values(array_filter([$ministry->age_range ? ['fas fa-users', $ministry->age_range] : null, $ministry->meeting_schedule ? ['far fa-clock', $ministry->meeting_schedule] : null, $ministry->location ? ['fas fa-location-dot', $ministry->location] : null])),
])

<!-- Ministry Details -->
<section class="py-20 bg-white">
    <div class="site">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Main Content - 8 columns -->
            <div class="lg:col-span-8 order-2 lg:order-1" data-aos="fade-up">
                <h2 class="text-3xl font-bold text-pcg-blue-900 mb-6">About This Ministry</h2>
                
                <!-- Full Content with Rich Text Support -->
                @if($ministry->content)
                    <div class="ministry-content prose-body">
                        @if($ministry->content !== strip_tags($ministry->content))
                            {{-- Formatted in the dashboard editor --}}
                            {!! $ministry->content !!}
                        @else
                            {{-- Plain text: blank lines separate paragraphs --}}
                            @foreach(preg_split('/\R{2,}/', trim($ministry->content)) as $paragraph)
                                <p>{!! nl2br(e($paragraph)) !!}</p>
                            @endforeach
                        @endif
                    </div>
                @else
                    <div class="prose prose-lg max-w-none">
                        <p class="mb-4">
                            Join us in this ministry as we serve together and grow in faith. We welcome members of all backgrounds and experiences.
                        </p>
                        <p>
                            For more information about {{ $ministry->name }}, please contact our ministry leader or reach out through our contact page.
                        </p>
                    </div>
                @endif

                <!-- Call to Action -->
                <div class="mt-12 bg-gradient-to-r from-pcg-blue-50 to-pcg-red-50 p-8 rounded-2xl" data-aos="fade-up">
                    <h3 class="text-2xl font-bold text-pcg-blue-900 mb-4">Join Us!</h3>
                    <p class="text-gray-700 mb-6">
                        We'd love to have you join {{ $ministry->name }}. Get in touch with us to learn more about how you can get involved.
                    </p>
                    <a href="{{ route('contact') }}" class="inline-block bg-gradient-to-r from-pcg-blue-600 to-pcg-red-600 text-white px-8 py-4 rounded-full font-bold hover:from-pcg-blue-700 hover:to-pcg-red-700 transition duration-300 shadow-lg hover:shadow-xl">
                        Contact Us
                    </a>
                </div>
            </div>

            <!-- Sidebar - 4 columns -->
            <div class="lg:col-span-4 order-1 lg:order-2" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-gradient-to-br from-pcg-blue-50 to-pcg-red-50 rounded-2xl p-6 sticky top-24">
                    <h3 class="text-2xl font-bold text-pcg-blue-900 mb-6">Ministry Info</h3>
                    
                    <div class="space-y-3">
                        @if($ministry->ministry_category)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-pcg-blue-600 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Category</p>
                                <p class="text-gray-900 font-bold">{{ $ministry->ministry_category }}</p>
                            </div>
                        </div>
                        @endif

                        @if($ministry->meeting_schedule)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-pcg-red-600 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Meeting Time</p>
                                <p class="text-gray-900 font-bold">{{ $ministry->meeting_schedule }}</p>
                            </div>
                        </div>
                        @endif

                        @if($ministry->location)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-pcg-blue-600 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Location</p>
                                <p class="text-gray-900 font-bold">{{ $ministry->location }}</p>
                            </div>
                        </div>
                        @endif

                        @if($ministry->leader)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-pcg-red-600 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Ministry Leader</p>
                                <p class="text-gray-900 font-bold">{{ $ministry->leader }}</p>
                            </div>
                        </div>
                        @endif

                        @if($ministry->leader_phone)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-pcg-blue-600 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Phone</p>
                                <p class="text-gray-900 font-bold">{{ $ministry->leader_phone }}</p>
                            </div>
                        </div>
                        @endif

                        @if($ministry->contact_email)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-pcg-red-600 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Email</p>
                                <p class="text-gray-900 font-bold break-all">{{ $ministry->contact_email }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Back Button -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <a href="{{ $ministry->category == 'generational' ? route('ministries.generational') : route('ministries.inter-generational') }}" class="inline-flex items-center text-pcg-blue-600 hover:text-pcg-blue-800 font-semibold transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to {{ $ministry->category == 'generational' ? 'Generational' : 'Inter-Generational' }} Ministries
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Ministry Content Styling */
    .ministry-content {
        color: #374151;
        line-height: 1.8;
    }
    
    .ministry-content h1,
    .ministry-content h2,
    .ministry-content h3,
    .ministry-content h4 {
        color: #1e3a8a;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .ministry-content h1 { font-size: 2.25rem; }
    .ministry-content h2 { font-size: 1.875rem; }
    .ministry-content h3 { font-size: 1.5rem; }
    .ministry-content h4 { font-size: 1.25rem; }
    
    .ministry-content p {
        margin-bottom: 1.25rem;
        font-size: 1.125rem;
    }
    
    .ministry-content ul,
    .ministry-content ol {
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
        font-size: 1.125rem;
    }
    
    .ministry-content ul li {
        list-style-type: disc;
        margin-bottom: 0.5rem;
    }
    
    .ministry-content ol li {
        list-style-type: decimal;
        margin-bottom: 0.5rem;
    }
    
    .ministry-content strong {
        font-weight: 700;
        color: #1e3a8a;
    }
    
    .ministry-content em {
        font-style: italic;
    }
    
    .ministry-content a {
        color: #dc2626;
        text-decoration: underline;
    }
    
    .ministry-content a:hover {
        color: #991b1b;
    }
    
    .ministry-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #4b5563;
        background: #f3f4f6;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
    }
    
    .ministry-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.75rem;
        margin: 1.5rem 0;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .ministry-content hr {
        border: none;
        border-top: 2px solid #e5e7eb;
        margin: 2rem 0;
    }
</style>
@endpush

@push('scripts')
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
</script>
@endpush
