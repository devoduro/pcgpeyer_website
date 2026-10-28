<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Marks the document as scripted before first paint, so the image-reveal
         styles only apply where something can actually un-hide them. --}}
    <script>document.documentElement.classList.add('js');</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Presbyterian Church of Ghana - Peyer Memorial Congregation, Bantama - Kumasi. Worshipping together since 1957.')">
    <title>@yield('title', 'PCG Peyer Memorial Congregation')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/pcg_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/pcg_logo.png') }}">

    {{-- Fonts (Inter + Plus Jakarta Sans) are imported inside resources/css/app.css. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-white text-ink-800 antialiased">

    {{-- No loading screen: the hero and scroll reveals start as soon as the page is ready. --}}
    <script>window.__pageReady = true;</script>

    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:z-[100] focus:top-0 focus:left-0 focus:bg-white focus:text-brand-700 focus:px-5 focus:py-2.5 focus:rounded-br-xl focus:font-bold">
        Skip to main content
    </a>

    @include('partials.navigation')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        (function () {
            var calm = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            /* Scroll reveals start once the loader lifts, so the first screen animates in view. */
            function startReveals() {
                if (window.AOS) {
                    window.AOS.init({ duration: 850, easing: 'ease-out-quart', once: true, offset: 60, disable: calm });
                }
                countUp();
            }
            if (window.__pageReady) { startReveals(); } else { window.addEventListener('page-ready', startReveals, { once: true }); }

            /* Numbers marked data-count-to count up from zero when they scroll into view.
               The real figure is already in the markup, so nothing is lost without JavaScript. */
            function countUp() {
                var items = document.querySelectorAll('[data-count-to]');
                if (!items.length || calm || !('IntersectionObserver' in window)) return;
                var io = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (!entry.isIntersecting) return;
                        io.unobserve(entry.target);
                        var el = entry.target, to = parseFloat(el.dataset.countTo), suffix = el.dataset.countSuffix || '';
                        var t0 = performance.now(), dur = 1600;
                        (function frame(now) {
                            var p = Math.min((now - t0) / dur, 1), eased = 1 - Math.pow(1 - p, 3);
                            el.textContent = Math.round(to * eased).toLocaleString() + suffix;
                            if (p < 1) requestAnimationFrame(frame);
                        })(t0);
                    });
                }, { threshold: 0.6 });
                items.forEach(function (el) { io.observe(el); });
            }

            /* Images marked data-reveal fade in as each one decodes; cached ones show at once. */
            document.querySelectorAll('img[data-reveal]').forEach(function (img) {
                var ready = function () { img.classList.add('is-ready'); };
                if (img.complete && img.naturalWidth) { ready(); }
                else { img.addEventListener('load', ready, { once: true }); img.addEventListener('error', ready, { once: true }); }
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>
