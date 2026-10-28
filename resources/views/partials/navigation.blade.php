@php
    /* One list feeds both the desktop dropdowns and the mobile accordion, so they cannot drift apart. */
    $menus = [
        'about' => ['About Us', request()->routeIs('about.*') || request()->routeIs('group-leadership.*'), [
            ['Brief History', route('about.history')],
            ['Church Leadership', route('about.leadership')],
            ['Group Leaders', route('group-leadership.index')],
            ['Past Leaders', route('about.ministers')],
        ]],
        'ministries' => ['Ministries', request()->routeIs('ministries.*'), [
            ['Inter-Generational Groups', route('ministries.inter-generational')],
            ['Generational Groups', route('ministries.generational')],
        ]],
        'media' => ['Media', request()->routeIs('media.*') || request()->routeIs('gallery.*'), [
            ['Photos', route('media.photos')],
            ['Videos', route('media.videos')],
        ]],
    ];

    $links = [
        ['Contact', route('contact'), request()->routeIs('contact')],
        ['News Update', route('news-update'), request()->routeIs('news-update*')],
    ];

    /* A thin accent rule under the current section reads as "you are here". */
    $navLink = 'nav-item relative inline-flex items-center gap-1.5 px-3 py-2 text-[15px] font-semibold whitespace-nowrap transition-colors duration-200
                after:absolute after:left-3 after:right-3 after:-bottom-0.5 after:h-[2px] after:rounded-full
                after:bg-accent-600 after:origin-left after:scale-x-0 after:transition-transform after:duration-200';
    $navIdle = 'text-ink-700 hover:text-accent-600 hover:after:scale-x-100';
    $navOn = 'is-on text-accent-600 after:scale-x-100';
    $panelItem = 'block px-3 py-2.5 text-sm text-ink-700 hover:text-accent-600 hover:bg-ink-50 rounded-lg transition-colors';
@endphp

<nav
    x-data="{
        mobile: false,
        open: null,
        timer: null,
        scrolled: false,
        overlay: true, {{-- every public page opens with a dark photo header --}}
        get clear() { return this.overlay && !this.scrolled && !this.mobile; },
        show(key) { clearTimeout(this.timer); this.open = key; },
        hide() { this.timer = setTimeout(() => { this.open = null; }, 180); },
        toggle(key) { clearTimeout(this.timer); this.open = (this.open === key ? null : key); }
    }"
    x-init="scrolled = window.scrollY > 8"
    @scroll.window="scrolled = window.scrollY > 8"
    @keydown.escape.window="open = null; mobile = false"
    :class="clear ? 'nav-clear bg-transparent border-transparent' : 'bg-white/95 backdrop-blur-md ' + (scrolled ? 'shadow-card border-ink-200/70' : 'border-ink-200/0')"
    class="sticky top-0 z-50 border-b transition-[background-color,box-shadow,border-color] duration-500"
>
    <div class="site">
        <div :class="scrolled ? 'h-[72px]' : 'h-20'" class="flex items-center justify-between gap-4 transition-[height] duration-300">

            {{-- Brand lockup in the style of the original logo: crest, a thin rule, then the
                 church name stacked in capitals. Set in type so it stays sharp and can turn white. --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0" aria-label="Peyer Memorial Congregation — home">
                <img src="{{ asset('images/pcg_logo.png') }}" alt="" :class="scrolled ? 'h-11' : 'h-[60px]'" class="w-auto transition-[height] duration-300">
                <span class="brand-rule w-px self-stretch my-1.5 bg-brand-700/40 transition-colors duration-500"></span>
                <span class="brand-lockup leading-none">
                    <span class="brand-eyebrow block text-[10px] font-bold uppercase tracking-[.06em] text-accent-600 transition-colors duration-500">Presbyterian Church of Ghana</span>
                    <span class="brand-name block mt-[2px] font-display text-[1.3rem] sm:text-[1.375rem] font-extrabold uppercase leading-none tracking-tight text-brand-800 transition-colors duration-500">Peyer Memorial</span>
                    <span class="brand-sub block mt-[2px] text-[.84rem] sm:text-[.875rem] font-semibold uppercase leading-none tracking-[.17em] text-brand-800 transition-colors duration-500">Congregation</span>
                    <span x-show="!scrolled" class="brand-location block mt-[4px] text-[9px] font-bold uppercase leading-none tracking-[.24em] text-ink-500 transition-colors duration-500">Bantama &middot; Kumasi</span>
                </span>
            </a>

            {{-- Desktop navigation --}}
            <div class="hidden lg:flex items-center gap-1 xl:gap-2" @click.outside="open = null">
                <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif
                   class="{{ $navLink }} {{ request()->routeIs('home') ? $navOn : $navIdle }}">Home</a>

                @foreach ($menus as $key => [$label, $active, $items])
                    <div class="relative" @mouseenter="show('{{ $key }}')" @mouseleave="hide()">
                        <button type="button" @click="toggle('{{ $key }}')" :aria-expanded="open === '{{ $key }}'"
                                class="{{ $navLink }} {{ $active ? $navOn : $navIdle }}">
                            {{ $label }}
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-200" :class="open === '{{ $key }}' && 'rotate-180'"></i>
                        </button>
                        <div x-show="open === '{{ $key }}'" x-cloak
                             x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                             class="absolute left-0 top-full pt-3 w-60">
                            <div class="card p-2">
                                @foreach ($items as [$itemLabel, $url])
                                    <a href="{{ $url }}" class="{{ $panelItem }}">{{ $itemLabel }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($links as [$label, $url, $active])
                    <a href="{{ $url }}" @if($active) aria-current="page" @endif
                       class="{{ $navLink }} {{ $active ? $navOn : $navIdle }}">{{ $label }}</a>
                @endforeach
            </div>

            <div class="flex items-center gap-2">
                <button type="button" @click="mobile = !mobile" :aria-expanded="mobile" aria-controls="mobile-menu" aria-label="Menu"
                        class="menu-btn lg:hidden inline-flex items-center justify-center w-11 h-11 rounded-xl text-ink-700 hover:bg-ink-100 transition-colors">
                    <i class="fas" :class="mobile ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="mobile-menu" x-show="mobile" x-cloak x-transition.opacity class="lg:hidden border-t border-ink-200 bg-white">
        <div class="site py-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg font-semibold {{ request()->routeIs('home') ? 'text-accent-600' : 'text-ink-700' }} hover:bg-ink-50">Home</a>

            @foreach ($menus as $key => [$label, $active, $items])
                <div>
                    <button type="button" @click="toggle('m-{{ $key }}')"
                            class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg font-semibold {{ $active ? 'text-accent-600' : 'text-ink-700' }} hover:bg-ink-50">
                        {{ $label }}
                        <i class="fas fa-chevron-down text-[11px] transition-transform" :class="open === 'm-{{ $key }}' && 'rotate-180'"></i>
                    </button>
                    <div x-show="open === 'm-{{ $key }}'" x-transition.opacity x-cloak class="pl-4">
                        @foreach ($items as [$itemLabel, $url])
                            <a href="{{ $url }}" class="{{ $panelItem }}">{{ $itemLabel }}</a>
                        @endforeach
                    </div>
                </div>
            @endforeach

            @foreach ($links as [$label, $url, $active])
                <a href="{{ $url }}" class="block px-3 py-2.5 rounded-lg font-semibold {{ $active ? 'text-accent-600' : 'text-ink-700' }} hover:bg-ink-50">{{ $label }}</a>
            @endforeach

            <a href="{{ route('contact') }}" class="btn-accent btn-block mt-3"><i class="fas fa-church"></i> Plan Your Visit</a>
        </div>
    </div>
</nav>
