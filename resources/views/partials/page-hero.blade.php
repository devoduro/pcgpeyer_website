{{--
    Header for inner pages: a congregation photo under the navy wash, with an eyebrow,
    title, optional subtitle and a breadcrumb trail. The site navigation sits transparent
    over it until the visitor scrolls.

    @include('partials.page-hero', [
        'title' => 'Past Leaders',
        'eyebrow' => 'About Us',                       // optional
        'subtitle' => 'Honouring those who served…',   // optional
        'image' => 'images/bantama/session.jpg',        // optional, public path or full URL
        'crumbs' => [['About Us', route('about.history')], ['Past Leaders']],  // optional; last item is the current page
        'meta' => [['fas fa-user', 'By the Clerk'], ['far fa-calendar', 'Oct 27, 2026']],  // optional facts row
    ])
--}}
@php
    $image = $image ?? 'images/bantama/womens_fellowship.jpg';
    $imageUrl = \Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image);
    $crumbs = $crumbs ?? [[$title]];
@endphp

<section class="page-hero relative -mt-20 overflow-hidden bg-navy-900 text-white">
    <div aria-hidden="true" class="page-hero__photo absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $imageUrl }}');"></div>
    <div aria-hidden="true" class="absolute inset-0"
         style="background: linear-gradient(100deg, rgba(8,11,34,.92) 0%, rgba(16,22,63,.82) 45%, rgba(29,42,107,.55) 100%), linear-gradient(0deg, rgba(8,11,34,.55) 0%, rgba(8,11,34,0) 50%);"></div>
    <div aria-hidden="true" class="page-hero__grain absolute inset-0"></div>
    <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-accent-600 via-accent-400 to-brand-500"></div>

    <div class="site relative z-[2] pt-40 pb-20 md:pt-44 md:pb-24">
        <nav aria-label="Breadcrumb" class="mb-6" data-aos="fade-down">
            <ol class="flex flex-wrap items-center gap-2 text-[13px] font-semibold text-white/70">
                <li><a href="{{ route('home') }}" class="hover:text-white transition-colors"><i class="fas fa-house text-[11px] mr-1"></i>Home</a></li>
                @foreach ($crumbs as $crumb)
                    <li aria-hidden="true"><i class="fas fa-chevron-right text-[9px] text-white/40"></i></li>
                    @if (! $loop->last && isset($crumb[1]))
                        <li><a href="{{ $crumb[1] }}" class="hover:text-white transition-colors">{{ $crumb[0] }}</a></li>
                    @else
                        <li aria-current="page" class="text-accent-300">{{ $crumb[0] }}</li>
                    @endif
                @endforeach
            </ol>
        </nav>

        @isset($eyebrow)
            <span class="hero-pill" data-aos="fade-up">{{ $eyebrow }}</span>
        @endisset
        <h1 class="max-w-4xl text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.08] text-white" data-aos="fade-up" data-aos-delay="100">{{ $title }}</h1>
        @isset($subtitle)
            <p class="mt-5 max-w-2xl text-lg md:text-xl text-white/85 leading-relaxed" data-aos="fade-up" data-aos-delay="200">{{ $subtitle }}</p>
        @endisset
        @if (! empty($meta))
            <ul class="mt-6 flex flex-wrap gap-x-6 gap-y-2 text-sm font-semibold text-white/80" data-aos="fade-up" data-aos-delay="300">
                @foreach ($meta as [$icon, $text])
                    <li class="inline-flex items-center gap-2"><i class="{{ $icon }} text-accent-300"></i>{{ $text }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</section>
