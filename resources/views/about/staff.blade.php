@extends('layouts.app')

@section('title', 'Administrative Staff - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=1920&h=600&fit=crop" alt="Administrative Staff" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-blue-800/90 to-pcg-blue-900/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">Administrative Staff</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">Meet the Team That Keeps Our Church Running Smoothly</p>
        <div class="w-24 h-1 bg-pcg-blue-400 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<!-- Staff Content -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold text-pcg-blue-900 mb-4">Our Dedicated Team</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Committed to serving our congregation with excellence and dedication</p>
            <div class="w-24 h-1 bg-pcg-blue-600 mx-auto mt-6"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Church Secretary -->
            <div class="group" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&h=600&fit=crop" alt="Church Secretary" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/90 via-pcg-blue-900/40 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-2xl font-bold text-white mb-1">Church Secretary</h3>
                            <p class="text-blue-200 font-semibold">Administrative Head</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Manages day-to-day administrative operations, correspondence, and record keeping for the congregation.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-pcg-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>secretary@pcgpeyer.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Secretary -->
            <div class="group" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?w=800&h=600&fit=crop" alt="Financial Secretary" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/90 via-pcg-blue-900/40 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-2xl font-bold text-white mb-1">Financial Secretary</h3>
                            <p class="text-blue-200 font-semibold">Finance Department</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Oversees financial records, budgeting, and ensures proper stewardship of church resources.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-pcg-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>finance@pcgpeyer.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organist -->
            <div class="group" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop" alt="Church Organist" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/90 via-pcg-blue-900/40 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-2xl font-bold text-white mb-1">Church Organist</h3>
                            <p class="text-blue-200 font-semibold">Music Ministry</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Leads worship through music, coordinates with the choir, and enhances our worship experience.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-pcg-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>music@pcgpeyer.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Caretaker -->
            <div class="group" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=800&h=600&fit=crop" alt="Church Caretaker" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/90 via-pcg-blue-900/40 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-2xl font-bold text-white mb-1">Church Caretaker</h3>
                            <p class="text-blue-200 font-semibold">Facilities Management</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Maintains church facilities, ensures cleanliness, and manages building security.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-pcg-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>facilities@pcgpeyer.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- IT Coordinator -->
            <div class="group" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=600&fit=crop" alt="IT Coordinator" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/90 via-pcg-blue-900/40 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-2xl font-bold text-white mb-1">IT Coordinator</h3>
                            <p class="text-blue-200 font-semibold">Technology Department</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Manages church technology, website, and digital communications systems.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-pcg-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>it@pcgpeyer.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Youth Coordinator -->
            <div class="group" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                    <div class="relative h-72 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800&h=600&fit=crop" alt="Youth Coordinator" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/90 via-pcg-blue-900/40 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <h3 class="text-2xl font-bold text-white mb-1">Youth Coordinator</h3>
                            <p class="text-blue-200 font-semibold">Youth Ministry</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 mb-4 leading-relaxed">
                            Coordinates youth programs, activities, and spiritual development initiatives.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-5 h-5 mr-3 text-pcg-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>youth@pcgpeyer.org</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="relative py-24 overflow-hidden" data-aos="fade-up">
    <div class="absolute inset-0 bg-gradient-to-br from-pcg-blue-900 to-pcg-blue-800"></div>
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-pcg-blue-500 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="icon-circle-lg bg-white/20 backdrop-blur-lg border-2 border-white/30 mx-auto mb-8">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">Need to Contact Our Staff?</h2>
        <p class="text-xl md:text-2xl text-gray-100 mb-10 max-w-2xl mx-auto">
            Our administrative team is here to serve you. Feel free to reach out with any questions or concerns.
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center bg-white text-pcg-blue-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition duration-300 shadow-2xl hover:shadow-3xl hover:scale-105 group">
            <svg class="w-6 h-6 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Contact Us Today
        </a>
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
