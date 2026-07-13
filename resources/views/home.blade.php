@extends('layouts.app')

@section('title', 'Home - PCG Monninger Congregation')

@section('content')
<!-- Hero Slider Section -->
<section class="relative h-screen overflow-hidden">
    <!-- Slider Container -->
    <div class="hero-slider relative h-full">
        <!-- Slide 1 -->
        <div class="hero-slide active absolute inset-0">
            <img src="images/sliders/slider1.jpg" alt="Church Building" class="w-full h-full object-cover kenburns">
            <div class="absolute inset-0 hero-slide-overlay"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
                    <div class="animate-fadeInUp">
                        <p class="text-xl md:text-2xl mb-4 text-pcg-red-300 font-semibold tracking-wide uppercase">Welcome to</p>
                        <h1 class="text-6xl md:text-8xl font-bold mb-6 leading-tight text-shadow-lg">
                            Monninger<br>
                            <span class="text-pcg-red-400">Congregation</span>
                        </h1>
                        <p class="text-xl md:text-3xl mb-8 text-gray-100 font-light max-w-3xl mx-auto">
                            Presbyterian Church of Ghana - Rev. Friedrich Monninger Congregation
                        </p>
                        <div class="w-24 h-1 bg-pcg-red-400 mx-auto mb-8"></div>
                        <p class="text-2xl md:text-3xl mb-10 italic text-white/90 font-serif">
                            "That They All May Be"
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('about.history') }}" class="btn-primary text-lg px-8 py-4">
                                Learn About Us
                            </a>
                            <a href="{{ route('contact') }}" class="btn-outline text-lg px-8 py-4">
                                Plan Your Visit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="hero-slide absolute inset-0 opacity-0">
            <img src="images/sliders/slider2.png" alt="Church Manse" class="w-full h-full object-cover kenburns">
            <div class="absolute inset-0 hero-slide-overlay"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
                    <div class="animate-fadeInUp">
                        
                        <h2 class="text-5xl md:text-7xl font-bold mb-6 leading-tight text-shadow-lg">
                            Our Church<br>
                            <span class="text-pcg-red-400">Manse</span>
                        </h2>
                        <p class="text-xl md:text-3xl mb-10 text-gray-100 font-light max-w-3xl mx-auto">
                            A home for our pastoral leadership, serving the spiritual needs of our congregation and community
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('about.history') }}" class="btn-primary text-lg px-8 py-4">
                                Learn More
                            </a>
                            <a href="{{ route('contact') }}" class="btn-outline text-lg px-8 py-4">
                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="hero-slide absolute inset-0 opacity-0">
            <img src="images/sliders/slider3.jpg" alt="Community Fellowship" class="w-full h-full object-cover kenburns">
            <div class="absolute inset-0 hero-slide-overlay"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-white px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
                    <div class="animate-fadeInUp">
                        
                        <h2 class="text-5xl md:text-7xl font-bold mb-6 leading-tight text-shadow-lg">
                            Grow in<br>
                            <span class="text-pcg-red-400">Community & Faith</span>
                        </h2>
                        <p class="text-xl md:text-3xl mb-10 text-gray-100 font-light max-w-3xl mx-auto">
                            Connect with a loving church family through our ministries, small groups, and fellowship events
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('ministries.inter-generational') }}" class="btn-primary text-lg px-8 py-4">
                                Explore Ministries
                            </a>
                            <a href="{{ route('contact') }}" class="btn-outline text-lg px-8 py-4">
                                Get Connected
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider Navigation Dots -->
    <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 z-20 flex space-x-3">
        <button class="slider-dot active w-3 h-3 rounded-full bg-white ring-2 ring-white/80 ring-offset-2 ring-offset-transparent transition-all duration-300" data-slide="0"></button>
        <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 ring-2 ring-white/60 ring-offset-2 ring-offset-transparent transition-all duration-300" data-slide="1"></button>
        <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white/80 ring-2 ring-white/60 ring-offset-2 ring-offset-transparent transition-all duration-300" data-slide="2"></button>
    </div>

    <!-- Slider Arrow Navigation -->
    <button class="slider-arrow slider-prev absolute left-8 top-1/2 transform -translate-y-1/2 z-20 w-14 h-14 rounded-full transition-all duration-300 flex items-center justify-center group">
        <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button class="slider-arrow slider-next absolute right-8 top-1/2 transform -translate-y-1/2 z-20 w-14 h-14 rounded-full transition-all duration-300 flex items-center justify-center group">
        <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce z-20">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

 
 

<!-- Welcome Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16" data-aos="fade-up" data-aos-delay="100">
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-pcg-blue-600 to-pcg-red-600 rounded-2xl transform rotate-3"></div>
                <img src="images/church_building.png" alt="Church Building" class="relative rounded-2xl shadow-2xl w-full h-96 object-cover">
            </div>
            <div>
                <h3 class="text-3xl font-bold text-pcg-blue-900 mb-6">Who We Are</h3>
                <p class="text-gray-700 text-lg mb-6 leading-relaxed">
                    We are a warm and welcoming community of believers committed to growing in faith, serving others, 
                    and sharing the love of Christ. Whether you're exploring faith for the first time or looking for 
                    a church to call home, we invite you to join us and experience the love and fellowship of our congregation.
                </p>
                <p class="text-gray-700 text-lg mb-8 leading-relaxed">
                    The Monninger Congregation is named after Rev. Friedrich Monninger, a missionary who dedicated his 
                    life to spreading the Gospel in Ghana. We continue his legacy of faith, service, and community building.
                </p>
                <a href="{{ route('about.history') }}" class="btn-secondary">
                    Our History
                </a>
            </div>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" data-aos="fade-up" data-aos-delay="150">
            <div class="relative h-48 rounded-lg overflow-hidden group">
                <img src="images/worship.png" alt="Worship" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                    <p class="text-white font-semibold">Worship</p>
                </div>
            </div>
            <div class="relative h-48 rounded-lg overflow-hidden group">
                <img src="images/fellowship.png" alt="Fellowship" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                    <p class="text-white font-semibold">Fellowship</p>
                </div>
            </div>
            <div class="relative h-48 rounded-lg overflow-hidden group">
                <img src="images/prayer.png" alt="Prayer" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                    <p class="text-white font-semibold">Prayer</p>
                </div>
            </div>
            <div class="relative h-48 rounded-lg overflow-hidden group">
                <img src="images/community.png" alt="Community" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                    <p class="text-white font-semibold">Community</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission, Vision, Values - Enhanced PCG Section -->
<section class="relative py-32 overflow-hidden bg-white" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-20">
            <div class="decorative-line"></div>
            <h2 class="text-5xl md:text-6xl font-bold text-pcg-blue-900 mb-6">Our Foundation</h2>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto">
                Guided by Presbyterian principles and committed to transforming lives through Christ
            </p>
        </div>

        <!-- Mission Section with Image -->
        <div class="mb-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-pcg-red-500 to-pcg-red-600 rounded-3xl opacity-20 blur-2xl"></div>
                        <div class="relative bg-white p-10 rounded-3xl shadow-2xl border-2 border-pcg-red-100">
                            <div class="flex items-center mb-6">
                             
                                <h3 class="text-4xl font-bold text-pcg-blue-900">Our Mission</h3>
                            </div>
                            <div class="space-y-4 text-gray-700 text-lg leading-relaxed">
                                <p class="font-semibold text-pcg-red-600 text-xl italic mb-4">
                                    "To uphold the Centrality of the Word of God and through the enablement of the Holy Spirit, pursue a holistic ministry, so as to bring all of creation to glorify God"
                                </p>
                                <p class="font-semibold text-pcg-blue-900 mb-3">
                                    Through:
                                </p>
                                <ul class="space-y-3 ml-6">
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-red-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Mobilizing the entire church for prayer</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-red-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Improving church growth through evangelism and nurture</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-red-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Attaining self-sufficiency through effective resource mobilization</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-red-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Promoting socio-economic development through advocacy and effective delivery of social service</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-red-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Upholding the Reformed Tradition</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-red-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Cherishing partnership with worldwide body of Christ</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative h-[500px] rounded-3xl overflow-hidden shadow-2xl group">
                        <img src="images/mission.jpg" alt="Mission" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/80 to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8 text-white">
                            <p class="text-3xl font-bold text-shadow-lg">Proclaiming Christ</p>
                            <p class="text-xl text-shadow">Making disciples of all nations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Values Section with Image -->
        <div class="mb-24">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-1">
                    <div class="relative h-[700px] rounded-3xl overflow-hidden shadow-2xl group">
                        <img src="images/minister.jpg" alt="Core Values" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-pcg-blue-900/80 to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8 text-white">
                           <p class="text-3xl font-bold text-shadow-lg">Rev. George Agyei Kwabi</p>
                            <p class="text-xl text-shadow">District Minister</p>
                        </div>
                    </div>
                </div>
                <div class="order-2">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-pcg-blue-500 to-pcg-blue-600 rounded-3xl opacity-20 blur-2xl"></div>
                        <div class="relative bg-white p-10 rounded-3xl shadow-2xl border-2 border-pcg-blue-100">
                            <div class="flex items-center mb-6">
                             
                                <h3 class="text-4xl font-bold text-pcg-blue-900">Our Core Values</h3>
                            </div>
                            <div class="space-y-4 text-gray-700 text-lg leading-relaxed">
                                <p class="font-semibold text-pcg-blue-600 text-xl mb-4">
                                    To harness the wholeness of the Church, we are guided by the following unwavering principles…
                                </p>
                                <ul class="space-y-3 ml-6">
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>The Centrality of the Word of God</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Discipline</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Hardwork</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Integrity</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Humility</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Unity</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Upholding Democratic Principles</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Godly Leadership and Skills Development</span>
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-6 h-6 text-pcg-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Sound Moral Principle</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      
    </div>
</section>

<!-- Service Times - Enhanced with Background Image -->
<section class="relative py-32 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1507692049790-de58290a4334?w=1920&h=1080&fit=crop" alt="Worship Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-blue-900/90 to-pcg-red-900/95"></div>
        <div class="absolute inset-0 bg-black/30"></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16" data-aos="fade-down">
            <div class="inline-block mb-6">
            
            </div>
            <h2 class="text-5xl md:text-6xl font-bold text-white mb-6 text-shadow-lg">Join Us for Worship</h2>
            <p class="text-2xl md:text-3xl text-white/90 mb-4 font-light">We would love to have you worship with us</p>
            <div class="w-24 h-1 bg-pcg-red-400 mx-auto"></div>
            <p class="text-lg text-white/80 mt-6 max-w-2xl mx-auto leading-relaxed">
                Experience authentic worship, powerful teaching, and genuine fellowship in a welcoming environment where everyone belongs.
            </p>
        </div>

        <!-- Service Times Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto mb-12">
            <!-- Sunday Service -->
            <div class="group" data-aos="fade-up" data-aos-delay="100">
                <div class="relative bg-white/10 backdrop-blur-xl rounded-2xl p-10 border-2 border-white/20 hover:border-white/40 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl overflow-hidden">
                    <!-- Featured Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="bg-pcg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">MAIN SERVICE</span>
                    </div>
                    
                    <div class="flex items-center justify-center mb-6">
                        <div class="icon-circle-lg bg-pcg-red-500 text-white group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-white text-center mb-4">Sunday Services</h3>
                    
                    <!-- 1st Service -->
                    <div class="text-center mb-4 pb-4 border-b border-white/20">
                        <p class="text-lg text-white/80 mb-2">1st Service</p>
                        <div class="flex items-center justify-center gap-3">
                            <p class="text-3xl font-bold text-pcg-red-300">7:00 AM</p>
                            <p class="text-xl text-white/80">to</p>
                            <p class="text-3xl font-bold text-pcg-red-300">9:00 AM</p>
                        </div>
                    </div>
                    
                    <!-- 2nd Service -->
                    <div class="text-center mb-6">
                        <p class="text-lg text-white/80 mb-2">2nd Service (Forenoon)</p>
                        <div class="flex items-center justify-center gap-3">
                            <p class="text-3xl font-bold text-pcg-red-300">9:30 AM</p>
                            <p class="text-xl text-white/80">to</p>
                            <p class="text-3xl font-bold text-pcg-red-300">12:00 PM</p>
                        </div>
                    </div>
                    
                    <p class="text-white/90 text-center text-lg leading-relaxed mb-6">
                        Join us for worship, praise, and powerful preaching every Sunday morning. Experience the presence of God with us.
                    </p>
                    
                    <!-- Service Highlights -->
                    <div class="space-y-2 mb-6">
                     
                        <div class="flex items-center justify-center text-white/80 text-sm">
                            <svg class="w-4 h-4 mr-2 text-pcg-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span>Biblical Preaching</span>
                        </div>
                        <div class="flex items-center justify-center text-white/80 text-sm">
                            <svg class="w-4 h-4 mr-2 text-pcg-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span>Children's Ministry Available</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-center text-white/70 text-sm pt-4 border-t border-white/10">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <span>Church Auditorium, Akosombo</span>
                    </div>
                </div>
            </div>

            <!-- Weekly Activities -->
            <div class="group" data-aos="fade-up" data-aos-delay="200">
                <div class="relative bg-white/10 backdrop-blur-xl rounded-2xl p-10 border-2 border-white/20 hover:border-white/40 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl overflow-hidden">
                    <!-- Badge -->
                    <div class="absolute top-4 right-4">
                        <span class="bg-pcg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">WEEKLY</span>
                    </div>
                    
                    <div class="flex items-center justify-center mb-6">
                        <div class="icon-circle-lg bg-pcg-blue-500 text-white group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold text-white text-center mb-6">Weekly Activities</h3>
                    
                    <!-- Activities List -->
                    <div class="space-y-3 text-white/90 text-sm">
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Sundays (2nd of Month):</span>
                            <span class="text-right">Session Meeting (12:00pm - 4:30pm)</span>
                        </div>
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Sundays:</span>
                            <span class="text-right">B.S.P.G Meeting (6:30pm - 8:00pm)</span>
                        </div>
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Monday:</span>
                            <span class="text-right">Prayer Team (7:00pm - 9:00pm)</span>
                        </div>
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Tuesdays:</span>
                            <span class="text-right">Church Bible Study (7:00pm - 8:30pm)</span>
                        </div>
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Wednesdays:</span>
                            <span class="text-right">Women Fellowship (5:00pm - 7:00pm)</span>
                        </div>
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Wednesdays:</span>
                            <span class="text-right">Y.A.F. M/F & YPG (7:00pm - 8:30pm)</span>
                        </div>
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Thursdays:</span>
                            <span class="text-right">Church Choir, MCS, Singing Band (7:00pm - 8:30pm)</span>
                        </div>
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Fridays:</span>
                            <span class="text-right">Prayer Meeting (7:00pm - 8:30pm)</span>
                        </div>
                        <div class="flex justify-between items-start border-b border-white/10 pb-2">
                            <span class="font-semibold text-white">Saturdays:</span>
                            <span class="text-right">Church Choir (7:00pm - 8:30pm)</span>
                        </div>
                        <div class="flex justify-between items-start">
                            <span class="font-semibold text-white">Saturdays:</span>
                            <span class="text-right">Praises Team (4:30pm - 6:30pm)</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-center text-white/70 text-sm pt-6 mt-6 border-t border-white/10">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Join us for fellowship and spiritual growth</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- What to Expect Section
        <div class="max-w-6xl mx-auto mb-12" data-aos="fade-up" data-aos-delay="300">
            <h3 class="text-3xl font-bold text-white text-center mb-8">What to Expect When You Visit</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 text-center group">
                    <div class="icon-circle-lg bg-gradient-to-br from-pcg-red-500 to-pcg-red-600 mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-white font-bold mb-2 text-lg">Warm Welcome</h4>
                    <p class="text-white/80 text-sm leading-relaxed">Friendly greeters will welcome you and help you feel at home from the moment you arrive</p>
                </div>

                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 text-center group">
                    <div class="icon-circle-lg bg-gradient-to-br from-pcg-blue-500 to-pcg-blue-600 mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-white font-bold mb-2 text-lg">Casual Dress</h4>
                    <p class="text-white/80 text-sm leading-relaxed">Come as you are! We value your presence, not your attire. Dress comfortably</p>
                </div>

                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 text-center group">
                    <div class="icon-circle-lg bg-gradient-to-br from-pcg-red-500 to-pcg-red-600 mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h4 class="text-white font-bold mb-2 text-lg">Sound Teaching</h4>
                    <p class="text-white/80 text-sm leading-relaxed">Biblical messages that are relevant, practical, and life-changing</p>
                </div>

                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 hover:bg-white/15 transition-all duration-300 text-center group">
                    <div class="icon-circle-lg bg-gradient-to-br from-pcg-blue-500 to-pcg-blue-600 mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h4 class="text-white font-bold mb-2 text-lg">Free Parking</h4>
                    <p class="text-white/80 text-sm leading-relaxed">Ample parking space available for all visitors and members</p>
                </div>
            </div>
        </div>
 -->
        <!-- Call to Action -->
        <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
            <a href="{{ route('contact') }}" class="inline-flex items-center bg-white text-pcg-blue-900 hover:bg-pcg-red-600 hover:text-white font-bold text-lg px-10 py-5 rounded-full transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl group">
                <span>Plan Your Visit</span>
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
                   </div>
    </div>
</section>

<!-- Our Videos -->
@include('sections.videos')

<!-- News Updates -->
@include('sections.news')

<!-- Photo Gallery -->
@include('sections.gallery')

<!-- Ministries Scrolling -->
@include('sections.ministries-scroll')

 
<!-- Call to Action -->
<section class="relative py-32 overflow-hidden" data-aos="fade-up">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=1920&h=800&fit=crop" alt="Join Our Church" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-pcg-blue-900/95 via-pcg-blue-800/90 to-pcg-blue-900/95"></div>
    </div>
    
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-pcg-blue-500 rounded-full filter blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>
    
    <!-- Content -->
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Icon -->
         
        
        <!-- Heading -->
        <h2 class="text-5xl md:text-7xl font-bold text-white mb-6 text-shadow-lg" data-aos="fade-up" data-aos-delay="100">
            Ready to Join Us?
        </h2>
        
        <!-- Decorative Line -->
        <div class="w-32 h-1 bg-pcg-blue-400 mx-auto mb-8 animate-expand" data-aos="zoom-in" data-aos-delay="200"></div>
        
        <!-- Description -->
        <p class="text-xl md:text-2xl mb-12 text-white/95 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="300">
            We would love to welcome you to our church family. Come experience the warmth of our fellowship, 
            the depth of our worship, and the power of growing together in Christ.
        </p>
        
        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="400">
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition duration-300">
                <div class="icon-circle bg-white/20 text-white mb-4 mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Warm Community</h3>
                <p class="text-white/80 text-sm">A welcoming family that cares</p>
            </div>
            
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition duration-300">
                <div class="icon-circle bg-white/20 text-white mb-4 mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Biblical Teaching</h3>
                <p class="text-white/80 text-sm">Grounded in God's Word</p>
            </div>
            
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition duration-300">
                <div class="icon-circle bg-white/20 text-white mb-4 mx-auto">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Active Service</h3>
                <p class="text-white/80 text-sm">Making a difference together</p>
            </div>
        </div>
        
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="zoom-in" data-aos-delay="500">
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center bg-white text-pcg-blue-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition duration-300 shadow-2xl hover:shadow-3xl hover:scale-105 group">
                <svg class="w-6 h-6 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Contact Us Today
            </a>
            <a href="{{ route('about.history') }}" class="inline-flex items-center justify-center bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-pcg-blue-900 transition duration-300 shadow-2xl hover:shadow-3xl hover:scale-105 group">
                <svg class="w-6 h-6 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Learn More About Us
            </a>
        </div>
        
        <!-- Additional Info -->
        <div class="mt-12 pt-8 border-t border-white/20" data-aos="fade-up" data-aos-delay="600">
            <p class="text-white/80 text-lg mb-4">Visit us this Sunday</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-white">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-pcg-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-semibold">1ST SERVICE(7:00 AM - 9:00 AM)</span>
                </div>
                <div class="hidden sm:block w-1 h-1 bg-white/40 rounded-full"></div>
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-pcg-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                     </svg>
                    <span class="font-semibold">2ND SERVICE(9:30 AM - 12:00 PM)</span>
                </div>
            </div>
        </div>
        
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-white">
                 
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-pcg-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <span class="font-semibold">Akosombo, Ghana</span>
                </div>
            </div>
         
    </div>
</section>
@endsection
