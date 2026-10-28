@extends('layouts.app')

@section('title', 'Our History - PCG Peyer Memorial Congregation')

@php
    $years = now()->year - 1957;

    $founders = [
        ['Charles Paul Amponsah', 'Opened his home as a meeting place'],
        ['Ernest E. Asare', 'Elected 24th August 1958'],
        ['Samuel Koranteng', 'Elected 24th August 1958'],
        ['E. A. Mensah', 'Elected 24th August 1958'],
        ['Ben O. Afful', 'Elected 24th August 1958'],
    ];

    // [year, date, title, text, icon]
    $milestones = [
        ['1957', null, 'A Morning Devotion begins',
         'Members of Ramseyer Memorial Presbyterian Church, Adum, gather at three places in Bantama for morning devotion. Mr B. R. D. Anane, headteacher of Bantama Presbyterian School, serves as the first catechist.',
         'fa-sun'],
        ['1958', '24th August', 'Five members take charge',
         'Within four months adult membership grows from fifteen to two hundred, and five members are elected to manage the affairs of the young congregation.',
         'fa-people-group'],
        ['1961', null, 'Bible Study and Prayer Group',
         'The BSPG is formed, bringing regular Bible study and house-to-house evangelism to Bantama.',
         'fa-book-bible'],
        ['1962', null, 'The Church Choir is founded',
         'Mr A. B. A. Danso, headteacher of Bantama Presbyterian Primary School, becomes the first choirmaster.',
         'fa-music'],
        ['1967', '1st October', 'Sod cutting for the chapel',
         'Work begins on a permanent chapel, while the congregation worships in classrooms of the Bantama Presbyterian Block "B" School.',
         'fa-trowel-bricks'],
        ['1968', '1st April', 'The first resident minister',
         'The Asante Presbytery appoints Rev. S. R. Essah as the first resident minister of the congregation.',
         'fa-user-tie'],
        ['1970', '8th November', 'Foundation stone laid',
         'Rev. Ernst Peyer of the Basel Mission lays the foundation stone of the Bantama chapel.',
         'fa-cube'],
        ['1978', '12th March', 'Bantama becomes a District',
         'Under Rev. M. O. Amoh the chapel is roofed, panelled and plastered, membership reaches seven hundred, and Bantama is raised to District status.',
         'fa-sitemap'],
        ['1990', '3rd June', 'Named Peyer Memorial',
         'The chapel is dedicated and the congregation named Peyer Memorial Congregation, in honour of Rev. Ernst Peyer.',
         'fa-church'],
        ['2017', '19th November', 'Sixty years of grace',
         'The congregation celebrates its 60th anniversary, giving thanks for all God has done since 1957.',
         'fa-award'],
        ['2026', '4th October', 'A new chapter',
         'Rev. Dr. Kofi Amfo-Akonnor is inducted as Bantama District Minister and Minister in Charge of Peyer Memorial Congregation.',
         'fa-dove'],
    ];
@endphp

@section('content')
@include('partials.page-hero', [
    'title' => 'Our History',
    'eyebrow' => 'Since 1957',
    'subtitle' => 'From a Morning Devotion group in Bantama homes to a congregation of over five thousand members.',
    'image' => 'images/bantama/church_aerial.jpg',
    'crumbs' => [['About Us', route('about.history')], ['Our History']],
    'meta' => [['fas fa-location-dot', 'Bantama, Kumasi'], ['fas fa-church', 'Peyer Memorial since 1990']],
])

{{-- ── How it began ───────────────────────────────────────────────────── --}}
<section class="section-padding bg-white overflow-hidden">
    <div class="site grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">
        <div data-aos="fade-right">
            <span class="eyebrow">How It Began</span>
            <h2 class="section-title mt-3">From a Morning Devotion to a Mother Church</h2>
            <div class="space-y-5 text-lg text-ink-600 leading-relaxed">
                <p>
                    Peyer Memorial Congregation began as a Morning Devotion group in the time of the
                    Very Rev. E. M. L. Odjidja, Pastor in charge of Ramseyer Memorial Presbyterian Church, Adum.
                    Members met at three places in Bantama, and their passion for souls was so great that within
                    four months adult membership grew from fifteen to two hundred.
                </p>
                <p>
                    On 24th August 1958, five members were elected to manage the affairs of the young congregation.
                    Mr Charles Paul Amponsah opened his home for worship, and the congregation grew into the
                    Bantama Presbyterian Church, a District and a mother of many churches across Kumasi.
                </p>
                <p class="text-ink-900 font-semibold">
                    Today, over five thousand members call Peyer Memorial home.
                </p>
            </div>
        </div>

        <div class="relative pb-10 lg:pb-0" data-aos="fade-left">
            <div class="ratio-4x3 rounded-[22px] shadow-lift">
                <img src="{{ asset('images/bantama/trad_sunday.jpg') }}" alt="Traditional Sunday at Peyer Memorial Congregation" loading="lazy">
            </div>
            <div class="absolute -bottom-2 left-4 sm:-left-6 lg:-bottom-10 w-44 sm:w-52 card p-4 text-center animate-float">
                <img src="{{ asset('images/bantama/anniversary.jpg') }}" alt="60th anniversary emblem, 1957 to 2017" class="w-full h-auto" loading="lazy">
                <p class="mt-2 text-xs font-bold uppercase tracking-wider text-ink-500">60th Anniversary &middot; 2017</p>
            </div>
            <div class="absolute -top-5 right-4 sm:-right-5 bg-accent-600 text-white rounded-2xl px-5 py-4 shadow-lift">
                <p class="text-3xl font-extrabold leading-none tabular-nums" data-count-to="{{ $years }}">{{ $years }}</p>
                <p class="text-xs font-bold uppercase tracking-wider mt-1 text-white/85">Years of grace</p>
            </div>
        </div>
    </div>
</section>

{{-- ── At a glance ────────────────────────────────────────────────────── --}}
<section class="bg-navy-900 text-white">
    <div class="site grid grid-cols-2 lg:grid-cols-4 divide-x divide-y lg:divide-y-0 divide-white/10">
        {{-- Years are shown as they are; quantities count up as they scroll into view. --}}
        @foreach ([
            ['1957', null, 'Morning Devotion begins'],
            ['5,000+', 5000, 'Members today'],
            ['20+', 20, 'Ministers have served'],
            ['1978', null, 'Raised to a District'],
        ] as [$value, $countTo, $label])
            <div class="py-10 px-4 text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <p class="text-4xl md:text-5xl font-extrabold tabular-nums"
                   @if ($countTo) data-count-to="{{ $countTo }}" data-count-suffix="+" @endif>{{ $value }}</p>
                <p class="mt-2 text-sm font-semibold uppercase tracking-wider text-white/60">{{ $label }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- ── Founders ───────────────────────────────────────────────────────── --}}
<section class="section-padding bg-page">
    <div class="site">
        <div class="text-center max-w-2xl mx-auto mb-14" data-aos="fade-up">
            <span class="eyebrow">24th August 1958</span>
            <h2 class="section-title mt-3">The First Five</h2>
            <p class="text-lg text-ink-500">The members elected to look after the young congregation in its first year.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4 md:gap-5">
            @foreach ($founders as [$name, $note])
                <div class="card card-hover p-5 md:p-6 text-center {{ $loop->first ? 'col-span-2 md:col-span-1' : '' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 90 }}">
                    <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-brand-50 text-brand-700 grid place-items-center text-lg font-extrabold">
                        {{ $name[0] . strrchr(' ' . $name, ' ')[1] }}
                    </div>
                    <h3 class="!text-base md:!text-lg font-extrabold text-ink-900 leading-snug">{{ $name }}</h3>
                    <p class="mt-1.5 text-sm text-ink-500">{{ $note }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── Timeline ───────────────────────────────────────────────────────── --}}
<section class="section-padding bg-white">
    <div class="site">
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
            <span class="eyebrow">Milestones</span>
            <h2 class="section-title mt-3">Our Journey of Faith</h2>
            <p class="text-lg text-ink-500">"Hitherto hath the Lord helped us." 1 Samuel 7:12</p>
        </div>

        {{-- Year on the left (from md), a dot on the line, the story in a card on the right. --}}
        <ol class="relative max-w-4xl mx-auto">
            <span class="absolute top-2 bottom-2 left-5 md:left-[9.5rem] w-0.5 -translate-x-1/2 bg-gradient-to-b from-accent-600 via-brand-300 to-brand-600" aria-hidden="true"></span>

            @foreach ($milestones as [$year, $date, $title, $text, $icon])
                <li class="relative pl-16 md:pl-[12rem] pb-6 last:pb-0" data-aos="fade-up">
                    <div class="hidden md:block absolute left-0 top-4 w-[7.5rem] text-right">
                        <p class="text-3xl font-extrabold text-accent-600 tabular-nums leading-none">{{ $year }}</p>
                        @if ($date)
                            <p class="mt-1.5 text-sm font-semibold text-ink-400">{{ $date }}</p>
                        @endif
                    </div>

                    <span class="absolute left-5 md:left-[9.5rem] top-4 -translate-x-1/2 w-10 h-10 rounded-full bg-white border-2 border-accent-600 text-accent-600 grid place-items-center shadow-card z-10">
                        <i class="fas {{ $icon }} text-sm"></i>
                    </span>

                    <div class="card card-hover px-6 py-5">
                        <p class="md:hidden text-sm font-bold text-accent-600 tabular-nums">{{ $date ? $date . ' ' : '' }}{{ $year }}</p>
                        <h3 class="!text-lg md:!text-xl font-extrabold text-ink-900">{{ $title }}</h3>
                        <p class="mt-1.5 text-ink-600 leading-relaxed">{{ $text }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ── Rev. Ernst Peyer ───────────────────────────────────────────────── --}}
<section class="section-padding bg-page overflow-hidden">
    <div class="site grid lg:grid-cols-2 gap-14 lg:gap-20 items-center">
        <div class="relative" data-aos="fade-right">
            <div class="ratio-4x3 rounded-[22px] shadow-lift">
                <img src="{{ asset('images/bantama/hero_church.jpg') }}" alt="Peyer Memorial Presbyterian Church, Bantama" loading="lazy">
            </div>
            <div class="absolute -bottom-6 right-4 sm:-right-6 card px-6 py-5 max-w-[16rem]">
                <p class="text-xs font-bold uppercase tracking-wider text-ink-400">Foundation stone</p>
                <p class="mt-1 text-lg font-extrabold text-ink-900">8th November 1970</p>
                <p class="text-sm text-ink-500">Laid by Rev. Ernst Peyer</p>
            </div>
        </div>

        <div data-aos="fade-left">
            <span class="eyebrow">Our Namesake</span>
            <h2 class="section-title mt-3">Rev. Ernst Peyer</h2>
            <div class="space-y-5 text-lg text-ink-600 leading-relaxed">
                <p>
                    Rev. Ernst Peyer was a Basel Mission Representative in Ghana who lived much of his life in Kumasi.
                    He was closely involved in planning the Bantama chapel, personally carrying the building plan to
                    the Presbyterian Headquarters in Accra, and he laid its foundation stone.
                </p>
                <p>
                    With his wife and friends of the mission in Switzerland, he was among the chapel's most generous
                    supporters. On 3rd June 1990, in recognition of his devotion, the church was dedicated and named
                    Peyer Memorial Congregation in his honour.
                </p>
            </div>
            <blockquote class="mt-8 border-l-4 border-accent-600 bg-white rounded-r-2xl px-6 py-5 shadow-card">
                <p class="text-xl italic text-ink-800">"Except the Lord build the house, they labour in vain that build it."</p>
                <footer class="mt-2 text-sm font-semibold text-ink-500">Psalm 127:1</footer>
            </blockquote>
        </div>
    </div>
</section>

{{-- ── Motto ──────────────────────────────────────────────────────────── --}}
<section class="hero-wash py-24 md:py-32 text-white"
         style="background-image: linear-gradient(160deg, rgba(16,22,63,.92) 0%, rgba(8,11,34,.94) 55%, rgba(127,29,29,.85) 100%), url('{{ asset('images/bantama/easter_service.jpg') }}');">
    <div class="site max-w-4xl text-center" data-aos="zoom-in-up">
        <span class="eyebrow !text-accent-300">Our Motto</span>
        <p class="mt-5 text-4xl md:text-6xl font-extrabold leading-tight">"That They All May Be One"</p>
        <p class="mt-4 text-lg font-semibold text-white/70">John 17:21</p>
        <p class="mt-8 text-lg md:text-xl text-white/85 leading-relaxed max-w-3xl mx-auto">
            Drawn from Jesus' prayer for His church, the motto of the Presbyterian Church of Ghana calls us to unity:
            every generation, every group and every member, one family in Christ.
        </p>
    </div>
</section>

{{-- ── Ministers in charge ────────────────────────────────────────────── --}}
@if ($shepherds->isNotEmpty())
<section class="section-padding bg-white">
    <div class="site">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12" data-aos="fade-up">
            <div class="max-w-2xl">
                <span class="eyebrow">Shepherds of the Flock</span>
                <h2 class="section-title mt-3 !mb-2">Ministers Who Have Served</h2>
                <p class="text-lg text-ink-500">The ministers in charge who have led Peyer Memorial since its first resident minister in 1968.</p>
            </div>
            <a href="{{ route('about.ministers') }}" class="btn-outline shrink-0">All Past Leaders <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($shepherds as $minister)
                <div class="flex items-center gap-4 rounded-2xl border border-ink-200/70 bg-page px-5 py-4 transition hover:border-accent-300 hover:bg-white hover:shadow-card"
                     data-aos="fade-up" data-aos-delay="{{ ($loop->index % 4) * 70 }}">
                    <span class="w-10 h-10 shrink-0 rounded-full bg-brand-600 text-white grid place-items-center text-sm font-extrabold tabular-nums">{{ $loop->iteration }}</span>
                    <div class="min-w-0">
                        <p class="font-bold text-ink-900 truncate">{{ $minister->name }}</p>
                        <p class="text-sm text-ink-500 tabular-nums">{{ $minister->year }}{{ $minister->year_end && $minister->year_end != $minister->year ? '–' . $minister->year_end : '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@include('partials.cta-band', [
    'eyebrow' => 'Our Story Continues',
    'title' => 'Become Part of the Story',
    'text' => 'The faith of fifteen people at a morning devotion still gathers thousands every Sunday. Come and worship with us at Bantama.',
    'primary' => ['Plan Your Visit', route('contact')],
    'secondary' => ['Our Ministries', route('ministries.generational')],
    'image' => 'images/bantama/hero_worship.jpg',
])
@endsection
