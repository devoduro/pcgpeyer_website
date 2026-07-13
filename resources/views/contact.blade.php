@extends('layouts.app')

@section('title', 'Contact Us - PCG Monninger Congregation')

@section('content')
<!-- Hero Header with Background Image -->
<section class="relative pt-32 pb-24 overflow-hidden" data-aos="fade-down" data-aos-duration="1000">
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1920&h=600&fit=crop" alt="Contact Us" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-pcg-blue-900/95 via-pcg-blue-800/90 to-pcg-blue-900/95"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="icon-circle-lg bg-white/20 backdrop-blur-lg border-2 border-white/30 mx-auto mb-8 animate-bounce-slow">
            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="text-5xl md:text-7xl font-bold mb-6 text-white text-shadow-lg" data-aos="fade-up" data-aos-delay="200">Contact Us</h1>
        <p class="text-2xl md:text-3xl text-gray-100 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="400">We'd Love to Hear From You</p>
        <div class="w-24 h-1 bg-pcg-blue-400 mx-auto animate-expand" data-aos="zoom-in" data-aos-delay="600"></div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold text-pcg-blue-900 mb-6">Get In Touch</h2>
                
                @if(session('success'))
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-400 rounded-xl px-6 py-4 mb-6 shadow-lg animate-fade-in">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4 animate-bounce">
                            <i class="fas fa-check text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold text-green-800 text-lg">Message Sent Successfully!</p>
                            <p class="text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Name *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pcg-blue-600 focus:border-transparent">
                        @error('name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Email *</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pcg-blue-600 focus:border-transparent">
                        @error('email')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                        <input type="tel" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pcg-blue-600 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Subject *</label>
                        <input type="text" name="subject" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pcg-blue-600 focus:border-transparent">
                        @error('subject')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Message *</label>
                        <textarea name="message" required rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pcg-blue-600 focus:border-transparent"></textarea>
                        @error('message')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <button type="submit" class="btn-primary w-full">Send Message</button>
                </form>
            </div>

            <div>
                <h2 class="text-3xl font-bold text-pcg-blue-900 mb-6">Contact Information</h2>
                
                <div class="space-y-6 mb-8">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-pcg-blue-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-pcg-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-pcg-blue-900 mb-1">Address</h3>
                            <p class="text-gray-600">Akosombo, Eastern Region<br>Ghana</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-pcg-red-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-pcg-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-pcg-blue-900 mb-1">Phone</h3>
                            <p class="text-gray-600">055 793 6254</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="icon-circle bg-pcg-blue-100 mr-4">
                            <svg class="w-6 h-6 text-pcg-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-pcg-blue-900 mb-1">Email</h3>
                            <p class="text-gray-600">presbymonninger@gmail.com</p>
                        </div>
                    </div>
                </div>

                <div class="card p-6 bg-pcg-blue-50">
                    <h3 class="font-bold text-pcg-blue-900 mb-4 text-xl">Service Times</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="font-semibold text-pcg-blue-900">1st Sunday Service</p>
                            <p class="text-gray-600">7:00 AM - 9:00 AM</p>
                        </div>
                        <div>
                            <p class="font-semibold text-pcg-blue-900">2nd Sunday Service</p>
                            <p class="text-gray-600"> 9:30 AM - 12:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
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
    
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
    
    .animate-expand {
        animation: expand 1s ease-out forwards;
    }
    
    .animate-fade-in {
        animation: fade-in 0.5s ease-out forwards;
    }
    
    /* Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush
