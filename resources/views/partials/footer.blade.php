@php
    $quickLinks = [
        ['Home', route('home')],
        ['Brief History', route('about.history')],
        ['Church Leadership', route('about.leadership')],
        ['Past Leaders', route('about.ministers')],
        ['Ministries', route('ministries.generational')],
        ['News Update', route('news-update')],
        ['Contact Us', route('contact')],
    ];

    $worship = [
        ['1st Service', 'Sundays, 7:00 – 9:00 AM'],
        ['2nd Service', 'Sundays, 9:30 AM – 12:00 PM'],
        ['Bible Study & Prayer (BSPG)', 'Wednesdays, 7:00 PM'],
        ["Men's & Women's Fellowship", 'Tuesdays'],
    ];

    $socials = [
        ['fab fa-facebook-f', 'Facebook', 'https://web.facebook.com/BantamaPresby/'],
        ['fab fa-instagram', 'Instagram', 'https://www.instagram.com/bantamapresby'],
        ['fab fa-youtube', 'YouTube', 'https://www.youtube.com/@bantamapresby'],
        ['fab fa-x-twitter', 'X', 'https://x.com/BantamaPresby'],
    ];

    $footerLink = 'block text-sm text-white/70 hover:text-accent-300 hover:translate-x-1 transition-all duration-200';
    $footerHeading = 'relative pb-2.5 mb-5 text-[1.1rem] font-bold text-white after:absolute after:bottom-0 after:left-0 after:w-10 after:h-[3px] after:bg-accent-500';
@endphp

<footer class="relative overflow-hidden bg-navy-900 bg-cover bg-center bg-no-repeat pt-16"
        style="background-image: url('{{ asset('images/bantama/church_aerial.jpg') }}');">
    <div aria-hidden="true" class="absolute inset-0"
         style="background-image: linear-gradient(160deg, rgba(16,22,63,.93) 0%, rgba(8,11,34,.96) 55%, rgba(29,42,107,.93) 100%);"></div>
    <div aria-hidden="true" class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-brand-500 via-accent-600 to-navy-500"></div>

    <div class="site relative z-[1]">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-12">

            {{-- About --}}
            <div class="sm:col-span-2 lg:col-span-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-5">
                    <img src="{{ asset('images/pcg_logo.png') }}" alt="" class="h-14 w-auto">
                    <span class="leading-tight">
                        <span class="block text-[10.5px] font-bold uppercase tracking-[.14em] text-accent-300">Presbyterian Church of Ghana</span>
                        <span class="block font-display text-xl font-extrabold text-white">Peyer Memorial Congregation</span>
                        <span class="block text-xs text-white/60">Bantama, Kumasi</span>
                    </span>
                </a>
                <p class="text-sm leading-relaxed text-white/75 mb-5">
                    Founded in 1957 as the Bantama Presbyterian Church and renamed in 1990 in honour of Rev. Ernst Peyer,
                    our congregation has grown from a Morning Devotion group into a family of over five thousand members.
                </p>
                <p class="text-xs italic text-white/60 mb-5">&ldquo;That They All May Be One&rdquo; &mdash; John 17:21</p>
                <div class="flex items-center gap-2.5">
                    @foreach ($socials as [$icon, $label, $url])
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $label }}"
                           class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/10 text-white hover:bg-accent-600 hover:-translate-y-0.5 transition-all duration-200">
                            <i class="{{ $icon }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick links --}}
            <div class="lg:col-span-2">
                <h5 class="{{ $footerHeading }}">Quick Links</h5>
                <div class="space-y-2.5">
                    @foreach ($quickLinks as [$label, $url])
                        <a href="{{ $url }}" class="{{ $footerLink }}">{{ $label }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Worship --}}
            <div class="lg:col-span-3">
                <h5 class="{{ $footerHeading }}">Worship With Us</h5>
                <div class="space-y-3.5">
                    @foreach ($worship as [$label, $time])
                        <div class="flex items-start gap-3">
                            <i class="fas fa-clock mt-1 w-4 text-center text-[13px] text-accent-400"></i>
                            <span>
                                <span class="block text-sm font-semibold text-white/90">{{ $label }}</span>
                                <span class="block text-xs text-white/55">{{ $time }}</span>
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Contact --}}
            <div class="lg:col-span-3">
                <h5 class="{{ $footerHeading }}">Contact Us</h5>
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-accent-400 text-[1.1rem] mt-0.5"></i>
                        <p class="text-sm leading-relaxed text-white/70">Peyer Memorial Congregation<br>Bantama, Kumasi<br>P.O. Box 1755, Kumasi, Ghana</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-envelope text-accent-400 text-[1.1rem] mt-0.5"></i>
                        <a href="mailto:info@pcgpeyer.org" class="text-sm text-white/70 hover:text-accent-300 transition-colors">info@pcgpeyer.org</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 py-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-[0.85rem] text-white/60">&copy; {{ date('Y') }} Presbyterian Church of Ghana &mdash; Peyer Memorial Congregation. All rights reserved.</p>
            <p class="text-[0.85rem] text-white/60">Powered by <a href="https://hicliqs.com" target="_blank" rel="noopener" class="text-accent-300 hover:underline">Hicliqs Ghana</a></p>
        </div>
    </div>
</footer>
