@extends('layouts.app')

@section('title', 'Home - PCG Peyer Memorial Congregation')

@section('content')
@php
    /* [photo, eyebrow, line one, line two, copy, primary link, primary label] */
    $slides = [
        ['images/bantama/hero_church.jpg', '', 'Welcome to', 'Peyer Memorial Congregation',
         'Presbyterian Church of Ghana, Bantama — Kumasi. A family of believers worshipping together since 1957.',
         route('contact'), 'Plan Your Visit'],
        ['images/bantama/hero_palm_sunday.jpg', 'HOSANNA!', 'Rejoice in the Lord', 'Always',
         'Children and mothers waving palms and singing Hosanna together. At Peyer Memorial, every generation shares the joy of worship.',
         route('gallery.index'), 'See Church Life'],
        ['images/bantama/hero_worship.jpg', 'WORSHIP WITH US', 'Sundays at', '7:00 & 9:30 AM',
         'Two services every Sunday, with Children\'s Service running alongside. Come as you are; you will be welcome.',
         route('contact'), 'Plan Your Visit'],
        ['images/bantama/hero_brigade.jpg', 'GROW IN FELLOWSHIP', 'A Place for', 'Every Generation',
         'From the Boys\' and Girls\' Brigade to the YPG, YAF, Women\'s and Men\'s Fellowships, there is a group for you.',
         route('ministries.generational'), 'Explore Ministries'],
    ];

    $meetings = [
        ['YPG', 'Sundays, 5:30 PM'],
        ['YAF', 'Sundays, after 2nd Service'],
        ['Singing Band', 'Sundays, after 2nd Service'],
        ["Men's Fellowship", 'Tuesdays, 7:00 PM'],
        ["Women's Fellowship", 'Tuesdays, 4:30 PM'],
        ['Church Choir', 'Tuesdays & Thursdays, 7:00 PM'],
        ['BSPG', 'Wednesdays, 7:00 PM'],
    ];

    $mission = [
        'Mobilizing the entire church for prayer',
        'Improving church growth through evangelism and nurture',
        'Attaining self-sufficiency through effective resource mobilization',
        'Promoting socio-economic development through advocacy and effective delivery of social service',
        'Upholding the Reformed Tradition',
        'Cherishing partnership with the worldwide body of Christ',
    ];

    $values = [
        'The Centrality of the Word of God', 'Discipline', 'Hard work', 'Integrity', 'Humility', 'Unity',
        'Upholding Democratic Principles', 'Godly Leadership and Skills Development', 'Sound Moral Principles',
    ];
@endphp

{{-- ── Hero slider ─────────────────────────────────────────────────────── --}}
<section x-cloak class="hero-section relative -mt-20 h-screen min-h-[640px] max-h-[920px] overflow-hidden bg-navy-900"
    x-data="{
        i: 0,
        n: {{ count($slides) }},
        timer: null,
        r: true,
        ready: false,
        touchX: 0,
        go(k) { this.i = (k + this.n) % this.n; this.restart(); },
        start() { this.timer = setInterval(() => { this.i = (this.i + 1) % this.n; }, 6000); },
        stop() { clearInterval(this.timer); },
        restart() { this.stop(); this.start(); }
    }"
    x-init="if (window.__pageReady) { ready = true } else { window.addEventListener('page-ready', () => ready = true, { once: true }) }; start()"
    @mouseenter="stop()" @mouseleave="r = false; $nextTick(() => { r = true; start(); })"
    @touchstart="touchX = $event.changedTouches[0].screenX"
    @touchend="Math.abs($event.changedTouches[0].screenX - touchX) > 50 && go(i + ($event.changedTouches[0].screenX < touchX ? 1 : -1))"
>
    @foreach ($slides as $index => [$img, $eyebrow, $titleA, $titleB, $copy, $href, $label])
        <div :class="i === {{ $index }} ? 'opacity-100 scale-100 z-[1]' : 'opacity-0 scale-[1.03] pointer-events-none z-0'"
             class="absolute inset-0 overflow-hidden transition-[opacity,transform] duration-[1200ms] ease-out">
            <div class="hero-photo absolute inset-0 bg-cover bg-center bg-no-repeat"
                 :class="i === {{ $index }} && 'is-active'"
                 style="background-image: url('{{ asset($img) }}');"></div>
            <div aria-hidden="true" class="hero-scrim absolute inset-0"></div>

            <div class="hero-body relative z-[2] h-full flex items-center">
                <div class="site w-full">
                    <div class="hero-copy" :class="i === {{ $index }} && ready && 'is-active'">
                        @if ($eyebrow)<span class="hero-eyebrow">{{ $eyebrow }}</span>@endif
                        @if ($index === 0)
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-5 leading-[1.1]">{{ $titleA }}<br><span class="text-accent-300">{{ $titleB }}</span></h1>
                        @else
                            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-5 leading-[1.1]">{{ $titleA }}<br><span class="text-accent-300">{{ $titleB }}</span></h2>
                        @endif
                        <p class="max-w-xl text-lg text-white/90 mb-8">{{ $copy }}</p>
                        <div class="flex flex-wrap gap-3">
                            <a href="{{ $href }}" class="btn-accent btn-lg">{{ $label }}</a>
                            <a href="{{ route('about.history') }}" class="btn-on-dark btn-lg">Who We Are</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <button type="button" @click="go(i - 1)" aria-label="Previous slide"
            class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-[3] w-11 h-11 rounded-full bg-white/20 text-white backdrop-blur hover:bg-white/35 transition-colors">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button type="button" @click="go(i + 1)" aria-label="Next slide"
            class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-[3] w-11 h-11 rounded-full bg-white/20 text-white backdrop-blur hover:bg-white/35 transition-colors">
        <i class="fas fa-chevron-right"></i>
    </button>

    <a href="#welcome" aria-label="Scroll down" class="hidden md:flex absolute bottom-8 left-1/2 -translate-x-1/2 z-[3] flex-col items-center gap-2 text-white/70 text-[11px] font-semibold tracking-[.2em] uppercase hover:text-white transition-colors">
        <span class="scroll-cue"></span>
    </a>

    <div class="absolute bottom-24 md:bottom-28 left-0 right-0 z-[3]">
        <div class="site flex items-center gap-4">
            <span class="hero-count" x-text="String(i + 1).padStart(2, '0') + ' / ' + String(n).padStart(2, '0')"></span>
            <div class="flex items-center gap-2">
                @foreach ($slides as $index => $slide)
                    <button type="button" @click="go({{ $index }})" :class="i === {{ $index }} && r ? 'is-active' : ''"
                            class="hero-bar" aria-label="Go to slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── Feature band overlapping the hero: worship times, group meetings, today's devotion ── --}}
<section id="welcome" class="relative z-10 -mt-16 md:-mt-20 pb-6 scroll-mt-24">
    <div class="site grid gap-5 md:grid-cols-3">
        <div class="card card-hover p-6" data-aos="fade-up">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-11 h-11 rounded-[14px] bg-brand-50 text-brand-600 flex items-center justify-center"><i class="fas fa-church"></i></span>
                <h3 class="text-lg font-extrabold text-ink-900">Sunday Worship</h3>
            </div>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between gap-3"><dt class="text-ink-500">1st Service</dt><dd class="font-bold text-ink-800">7:00 – 9:00 AM</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-ink-500">2nd Service</dt><dd class="font-bold text-ink-800">9:30 AM – 12:00 PM</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-ink-500">Children's Service</dt><dd class="font-bold text-ink-800">During both services</dd></div>
            </dl>
        </div>

        <div class="card card-hover p-6" data-aos="fade-up" data-aos-delay="120">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-11 h-11 rounded-[14px] bg-accent-50 text-accent-600 flex items-center justify-center"><i class="fas fa-people-group"></i></span>
                <h3 class="text-lg font-extrabold text-ink-900">This Week</h3>
            </div>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between gap-3"><dt class="text-ink-500">Men's &amp; Women's Fellowship</dt><dd class="font-bold text-ink-800">Tuesdays</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-ink-500">Bible Study &amp; Prayer</dt><dd class="font-bold text-ink-800">Wed, 7:00 PM</dd></div>
                <div class="flex justify-between gap-3"><dt class="text-ink-500">YPG</dt><dd class="font-bold text-ink-800">Sun, 5:30 PM</dd></div>
            </dl>
            <a href="#group-meetings" class="inline-flex items-center gap-2 mt-4 text-sm font-bold text-brand-600 hover:text-accent-600">All group meetings <i class="fas fa-arrow-right text-[11px]"></i></a>
        </div>

        <div class="card card-hover p-6 bg-gradient-to-br from-brand-700 to-navy-900 border-0 text-white" data-aos="fade-up" data-aos-delay="240">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-11 h-11 rounded-[14px] bg-white/15 text-white flex items-center justify-center"><i class="fas fa-book-bible"></i></span>
                <h3 class="text-lg font-extrabold text-white">Today's Devotion</h3>
            </div>
            @if ($todaysDevotional)
                <p class="font-display font-bold leading-snug mb-2">{{ $todaysDevotional->title }}</p>
                <p class="text-sm text-white/80 italic clamp-3 mb-3">&ldquo;{{ $todaysDevotional->scripture_text }}&rdquo;</p>
                <p class="text-xs font-bold uppercase tracking-wider text-accent-300">{{ $todaysDevotional->scripture_reference }}</p>
            @else
                <p class="text-sm text-white/80">A new devotion is posted every morning. Check back soon.</p>
            @endif
        </div>
    </div>
</section>

@include('sections.announcements')

{{-- ── Who we are ── --}}
<section class="section-padding bg-white">
    <div class="site">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-14">
            <div class="relative" data-aos="fade-right">
                <div class="ratio-4x3 rounded-[22px] shadow-lift">
                    <img src="{{ asset('images/bantama/church_aerial.jpg') }}" alt="Peyer Memorial Presbyterian Church, Bantama" data-reveal loading="lazy">
                </div>
                <div class="hidden md:flex absolute -bottom-8 -right-6 card p-4 items-center gap-3 animate-float" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{ asset('images/bantama/anniversary.jpg') }}" alt="60th anniversary emblem" class="w-16 h-16 rounded-full object-cover">
                    <span class="leading-tight">
                        <span class="block font-display text-2xl font-extrabold text-brand-700">1957</span>
                        <span class="block text-xs font-semibold text-ink-500">Founded at Bantama</span>
                    </span>
                </div>
            </div>
            <div data-aos="fade-left">
                <span class="eyebrow">Who We Are</span>
                <h2 class="section-title mt-2">A Church Family in the Heart of Bantama</h2>
                <div class="prose-body mb-8">
                    <p>
                        We are a warm and welcoming community of believers committed to growing in faith, serving others,
                        and sharing the love of Christ. Whether you're exploring faith for the first time or looking for
                        a church to call home, we invite you to join us.
                    </p>
                    <p>
                        Peyer Memorial Congregation began in 1957 as a Morning Devotion group and became the Bantama
                        Presbyterian Church. In 1990 it was dedicated and named in honour of Rev. Ernst Peyer, a Basel
                        Mission representative who supported the building of our chapel.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('about.history') }}" class="btn-primary">Our History</a>
                    <a href="{{ route('about.ministers') }}" class="btn-outline">Past Leaders</a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
            @foreach ([['easter_service', 'Worship', 'Easter Sunday service'], ['trad_sunday', 'Fellowship', 'Traditional Sunday'], ['jy_sunday', 'Youth', 'Junior Youth Sunday'], ['childrens_service', 'Children', "Children's Service"]] as [$photo, $label, $caption])
                <figure class="group relative ratio-4x3 rounded-[18px] shadow-card hover:shadow-lift transition-shadow duration-300" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 120 }}">
                    <img src="{{ asset('images/bantama/' . $photo . '.jpg') }}" alt="{{ $caption }}" class="transition-transform duration-700 ease-out group-hover:scale-110" data-reveal loading="lazy">
                    <figcaption class="absolute inset-0 flex flex-col justify-end p-4 bg-gradient-to-t from-navy-950/85 via-navy-950/20 to-transparent">
                        <span class="text-white font-bold">{{ $label }}</span>
                        <span class="text-white/70 text-xs">{{ $caption }}</span>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Our foundation: mission and core values ── --}}
<section class="section-padding bg-ink-50">
    <div class="site">
        <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
            <span class="eyebrow">Our Foundation</span>
            <h2 class="section-title mt-2">Guided by the Word, Rooted in the Reformed Tradition</h2>
            <p class="section-subtitle">As a congregation of the Presbyterian Church of Ghana, we share the Church's mission and values.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="card card-hover p-8 md:p-10" data-aos="fade-right">
                <span class="badge badge-accent mb-4">Our Mission</span>
                <p class="font-display text-xl font-bold text-ink-900 leading-snug mb-6">
                    &ldquo;To uphold the Centrality of the Word of God and through the enablement of the Holy Spirit, pursue a holistic ministry, so as to bring all of creation to glorify God.&rdquo;
                </p>
                <p class="text-sm font-bold text-ink-500 uppercase tracking-wider mb-3">Through</p>
                <ul class="space-y-3">
                    @foreach ($mission as $item)
                        <li class="flex items-start gap-3 text-ink-700"><i class="fas fa-circle-check text-accent-600 mt-1"></i><span>{{ $item }}</span></li>
                    @endforeach
                </ul>
            </div>

            <div class="card card-hover overflow-hidden group" data-aos="fade-left" data-aos-delay="100">
                <div class="ratio-16x9">
                    <img src="{{ asset('images/bantama/girls_brigade.jpg') }}" alt="Girls' Brigade enrolment, Powerful 11th Kumasi Company" class="transition-transform duration-700 ease-out group-hover:scale-105" data-reveal loading="lazy">
                </div>
                <div class="p-8 md:p-10">
                    <span class="badge badge-brand mb-4">Our Core Values</span>
                    <p class="text-ink-600 mb-5">To harness the wholeness of the Church, we are guided by these principles:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($values as $value)
                            <span class="inline-flex items-center px-3.5 py-2 rounded-xl bg-brand-50 text-brand-700 text-sm font-semibold">{{ $value }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Worship and group meetings ── --}}
<section id="group-meetings" class="hero-wash section-padding text-white" style="background-image: linear-gradient(160deg, rgba(16,22,63,.92) 0%, rgba(8,11,34,.95) 55%, rgba(29,42,107,.90) 100%), url('{{ asset('images/bantama/sunday_gallery.jpg') }}');">
    <div class="site">
        <div class="text-center max-w-3xl mx-auto mb-14" data-aos="fade-up">
            <span class="eyebrow !text-accent-300">Join Us</span>
            <h2 class="text-4xl md:text-5xl font-extrabold mt-2 mb-4">Worship and Fellowship</h2>
            <p class="text-lg text-white/80">We would love to have you worship with us, and to find your place in one of our groups.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 max-w-5xl mx-auto">
            <div class="lg:col-span-2 rounded-[18px] bg-white/10 border border-white/20 backdrop-blur p-8 transition-transform duration-300 hover:-translate-y-1" data-aos="fade-right">
                <span class="badge bg-accent-600 text-white mb-4">Main Services</span>
                <h3 class="text-2xl font-extrabold mb-6">Sunday Services</h3>
                <div class="space-y-5">
                    <div><p class="text-white/70 text-sm">1st Service</p><p class="text-2xl font-display font-extrabold">7:00 – 9:00 AM</p></div>
                    <div><p class="text-white/70 text-sm">2nd Service (Forenoon)</p><p class="text-2xl font-display font-extrabold">9:30 AM – 12:00 PM</p></div>
                </div>
                <p class="mt-6 pt-6 border-t border-white/15 text-sm text-white/75"><i class="fas fa-location-dot mr-2 text-accent-300"></i>Church Auditorium, Bantama - Kumasi</p>
            </div>

            <div class="lg:col-span-3 rounded-[18px] bg-white/10 border border-white/20 backdrop-blur p-8 transition-transform duration-300 hover:-translate-y-1" data-aos="fade-left" data-aos-delay="100">
                <span class="badge bg-white/15 text-white mb-4">Weekly</span>
                <h3 class="text-2xl font-extrabold mb-6">Group Meetings</h3>
                <dl class="divide-y divide-white/10 text-sm">
                    @foreach ($meetings as [$group, $time])
                        <div class="flex justify-between gap-4 py-2.5">
                            <dt class="font-semibold">{{ $group }}</dt>
                            <dd class="text-white/80 text-right">{{ $time }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>

        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('contact') }}" class="btn-accent btn-lg">Plan Your Visit <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>

@include('sections.videos')
@include('sections.news')
@include('sections.gallery')
@include('sections.ministries-scroll')

{{-- ── Call to action ── --}}
<section class="hero-wash py-24 text-white" style="background-image: linear-gradient(160deg, rgba(16,22,63,.92) 0%, rgba(8,11,34,.95) 55%, rgba(29,42,107,.90) 100%), url('{{ asset('images/bantama/harvest.jpg') }}');">
    <div class="site text-center max-w-3xl" data-aos="zoom-in-up">
        <span class="eyebrow !text-accent-300">You Are Welcome Here</span>
        <h2 class="text-4xl md:text-5xl font-extrabold mt-2 mb-5">Ready to Join Us?</h2>
        <p class="text-lg text-white/85 mb-10">
            Come experience the warmth of our fellowship, the depth of our worship, and the joy of growing together in Christ.
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('contact') }}" class="btn-accent btn-lg"><i class="fas fa-envelope"></i> Contact Us Today</a>
            <a href="{{ route('about.history') }}" class="btn-on-dark btn-lg">Learn More About Us</a>
        </div>
        <p class="mt-10 text-white/70 text-sm"><i class="fas fa-location-dot mr-2 text-accent-300"></i>Bantama, Kumasi &middot; P.O. Box 1755 &middot; info@pcgpeyer.org</p>
    </div>
</section>

@push('styles')
<style>
    .hero-body { padding-top: 5rem; padding-bottom: 9rem; }
    .hero-section:hover .hero-bar.is-active::after { animation-play-state: paused; }
    .hero-photo { transform: scale(1.05); will-change: transform; }
    .hero-photo.is-active { animation: hero-kenburns 12s ease-in-out infinite alternate; }
    @keyframes hero-kenburns {
        from { transform: scale(1.05) translate(0, 0); }
        to   { transform: scale(1.16) translate(-1.5%, -1%); }
    }
    .hero-scrim {
        background:
            linear-gradient(90deg, rgba(8,11,34,.86) 0%, rgba(8,11,34,.62) 40%, rgba(8,11,34,.18) 75%, rgba(8,11,34,.05) 100%),
            linear-gradient(0deg, rgba(8,11,34,.6) 0%, rgba(8,11,34,0) 40%);
    }
    /* Each line of the slide arrives in turn: eyebrow, headline, text, buttons. */
    .hero-copy { text-shadow: 0 2px 18px rgba(0,0,0,.35); }
    .hero-copy > * { opacity: 0; transform: translateY(30px); transition: opacity .6s ease, transform .6s ease; }
    .hero-copy.is-active > * { opacity: 1; transform: none; transition: opacity .9s cubic-bezier(.22,1,.36,1), transform .9s cubic-bezier(.22,1,.36,1); }
    .hero-copy.is-active > :nth-child(1) { transition-delay: .2s; }
    .hero-copy.is-active > :nth-child(2) { transition-delay: .38s; }
    .hero-copy.is-active > :nth-child(3) { transition-delay: .56s; }
    .hero-copy.is-active > :nth-child(4) { transition-delay: .74s; }
    .hero-eyebrow {
        display: inline-block; margin-bottom: 1.1rem; padding: .4rem .9rem;
        font-size: .78rem; font-weight: 700; letter-spacing: .18em; color: #fff;
        background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.28);
        border-radius: 999px; backdrop-filter: blur(8px); text-shadow: none;
    }
    .hero-count { color: rgba(255,255,255,.85); font-size: .85rem; font-weight: 600; letter-spacing: .1em; font-variant-numeric: tabular-nums; }
    .hero-bar { position: relative; width: 2rem; height: 4px; border-radius: 4px; background: rgba(255,255,255,.35); overflow: hidden; transition: background .3s; }
    .hero-bar:hover { background: rgba(255,255,255,.6); }
    .hero-bar::after { content: ''; position: absolute; inset: 0; background: #DC2626; transform: scaleX(0); transform-origin: left; }
    .hero-bar.is-active::after { animation: hero-fill 6s linear forwards; }
    @keyframes hero-fill { to { transform: scaleX(1); } }
    @media (prefers-reduced-motion: reduce) {
        .hero-copy > * { opacity: 1; transform: none; transition: none; }
        .hero-photo.is-active { animation: none; }
        .hero-bar.is-active::after { animation: none; transform: scaleX(1); }
    }
</style>
@endpush
@endsection
