{{--
    Closing call to action over a congregation photo.

    @include('partials.cta-band', [
        'title' => 'Find Your Place',
        'text' => 'There is a ministry waiting for you…',
        'eyebrow' => 'Get Involved',                                  // optional
        'primary' => ['Get Connected', route('contact')],
        'secondary' => ['Current Leadership', route('about.leadership')], // optional
        'image' => 'images/bantama/yaf.jpg',                          // optional
    ])
--}}
<section class="hero-wash py-20 md:py-24 text-white"
         style="background-image: linear-gradient(160deg, rgba(16,22,63,.93) 0%, rgba(8,11,34,.95) 55%, rgba(29,42,107,.90) 100%), url('{{ asset($image ?? 'images/bantama/mens_fellowship.jpg') }}');">
    <div class="site max-w-3xl text-center" data-aos="zoom-in-up">
        @isset($eyebrow)
            <span class="eyebrow !text-accent-300">{{ $eyebrow }}</span>
        @endisset
        <h2 class="text-3xl md:text-5xl font-extrabold mt-2 mb-5">{{ $title }}</h2>
        @isset($text)
            <p class="text-lg text-white/85 mb-9 leading-relaxed">{{ $text }}</p>
        @endisset
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ $primary[1] }}" class="btn-accent btn-lg">{{ $primary[0] }} <i class="fas fa-arrow-right"></i></a>
            @isset($secondary)
                <a href="{{ $secondary[1] }}" class="btn-on-dark btn-lg">{{ $secondary[0] }}</a>
            @endisset
        </div>
    </div>
</section>
