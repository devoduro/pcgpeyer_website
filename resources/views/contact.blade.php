@extends('layouts.app')

@section('title', 'Contact Us - PCG Peyer Memorial Congregation')

@section('content')
<!-- Hero Header with Background Image -->
@include('partials.page-hero', [
    'title' => 'Contact Us',
    'eyebrow' => "We'd Love to Hear From You",
    'subtitle' => 'Questions, prayer requests or planning a visit? Reach out and we will get back to you.',
    'image' => 'images/bantama/womens_fellowship.jpg',
    'crumbs' => [['Contact Us']],
])

{{-- Quick contact facts --}}
<section class="relative z-10 -mt-12 pb-4">
    <div class="site grid gap-5 md:grid-cols-3">
        @foreach ([
            ['fas fa-location-dot', 'Visit Us', 'Peyer Memorial Congregation, Bantama, Kumasi', 'P.O. Box 1755, Kumasi, Ghana', null],
            ['fas fa-envelope', 'Email Us', 'info@pcgpeyer.org', 'We reply as soon as we can', 'mailto:info@pcgpeyer.org'],
            ['fas fa-church', 'Sunday Worship', '1st Service 7:00 – 9:00 AM', '2nd Service 9:30 AM – 12:00 PM', null],
        ] as [$icon, $label, $line1, $line2, $href])
            <div class="card card-hover p-6 flex gap-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 120 }}">
                <span class="w-12 h-12 shrink-0 rounded-[14px] {{ $loop->odd ? 'bg-brand-50 text-brand-600' : 'bg-accent-50 text-accent-600' }} flex items-center justify-center text-lg"><i class="{{ $icon }}"></i></span>
                <div>
                    <p class="text-xs font-extrabold uppercase tracking-[.12em] text-ink-400 mb-1">{{ $label }}</p>
                    @if ($href)
                        <a href="{{ $href }}" class="font-bold text-ink-900 hover:text-accent-600 transition-colors">{{ $line1 }}</a>
                    @else
                        <p class="font-bold text-ink-900">{{ $line1 }}</p>
                    @endif
                    <p class="text-sm text-ink-500 mt-0.5">{{ $line2 }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="section-padding !pt-14 bg-white">
    <div class="site grid grid-cols-1 lg:grid-cols-5 gap-8">
        {{-- Message form --}}
        <div class="lg:col-span-3 card p-6 md:p-10" data-aos="fade-right">
            <span class="eyebrow">Get In Touch</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-ink-900 mt-2 mb-2">Send Us a Message</h2>
            <p class="text-ink-500 mb-8">Questions, prayer requests, or planning your first visit: we would love to hear from you.</p>

            @if(session('success'))
                <div class="flex items-start gap-4 rounded-xl border border-green-200 bg-green-50 px-5 py-4 mb-8" role="status">
                    <span class="w-10 h-10 shrink-0 rounded-full bg-green-600 text-white flex items-center justify-center"><i class="fas fa-check"></i></span>
                    <div>
                        <p class="font-bold text-green-800">Message sent</p>
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" class="grid gap-5 md:grid-cols-2">
                @csrf
                <div>
                    <label for="c-name" class="label">Name *</label>
                    <input id="c-name" type="text" name="name" value="{{ old('name') }}" required class="input @error('name') is-error @enderror" autocomplete="name">
                    @error('name')<p class="text-red-600 text-sm mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="c-email" class="label">Email *</label>
                    <input id="c-email" type="email" name="email" value="{{ old('email') }}" required class="input @error('email') is-error @enderror" autocomplete="email">
                    @error('email')<p class="text-red-600 text-sm mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="c-phone" class="label">Phone</label>
                    <input id="c-phone" type="tel" name="phone" value="{{ old('phone') }}" class="input @error('phone') is-error @enderror" autocomplete="tel">
                    @error('phone')<p class="text-red-600 text-sm mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="c-subject" class="label">Subject *</label>
                    <input id="c-subject" type="text" name="subject" value="{{ old('subject') }}" required class="input @error('subject') is-error @enderror">
                    @error('subject')<p class="text-red-600 text-sm mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <label for="c-message" class="label">Message *</label>
                    <textarea id="c-message" name="message" rows="6" required class="input @error('message') is-error @enderror">{{ old('message') }}</textarea>
                    @error('message')<p class="text-red-600 text-sm mt-1.5">{{ $message }}</p>@enderror
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="btn-accent btn-lg w-full md:w-auto"><i class="fas fa-paper-plane"></i> Send Message</button>
                </div>
            </form>
        </div>

        {{-- Map and connect --}}
        <div class="lg:col-span-2 flex flex-col gap-6" data-aos="fade-left">
            <div class="card overflow-hidden">
                <div class="aspect-[4/3] bg-ink-100">
                    <iframe title="Map: Peyer Memorial Presbyterian Church, Bantama, Kumasi" class="w-full h-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q=Peyer+Memorial+Presbyterian+Church,+Bantama,+Kumasi,+Ghana&amp;output=embed"></iframe>
                </div>
                <div class="p-5 flex items-center justify-between gap-3">
                    <div>
                        <p class="font-bold text-ink-900">Bantama, Kumasi</p>
                        <p class="text-sm text-ink-500">Church Auditorium</p>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&amp;query=Peyer+Memorial+Presbyterian+Church+Bantama+Kumasi" target="_blank" rel="noopener" class="btn-outline btn-sm"><i class="fas fa-diamond-turn-right"></i> Directions</a>
                </div>
            </div>

            <div class="card p-6 bg-gradient-to-br from-brand-700 to-navy-900 border-0 text-white">
                <p class="text-xs font-extrabold uppercase tracking-[.12em] text-accent-300 mb-2">Stay Connected</p>
                <p class="text-white/85 mb-5">Follow Bantama Presby for service streams, announcements and photos.</p>
                <div class="flex gap-2.5">
                    @foreach ([['fab fa-facebook-f', 'Facebook', 'https://web.facebook.com/BantamaPresby/'], ['fab fa-instagram', 'Instagram', 'https://www.instagram.com/bantamapresby'], ['fab fa-youtube', 'YouTube', 'https://www.youtube.com/@bantamapresby'], ['fab fa-x-twitter', 'X', 'https://x.com/BantamaPresby']] as [$icon, $label, $url])
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }}" class="w-11 h-11 rounded-full bg-white/10 hover:bg-accent-600 flex items-center justify-center transition-all duration-200 hover:-translate-y-0.5"><i class="{{ $icon }}"></i></a>
                    @endforeach
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
