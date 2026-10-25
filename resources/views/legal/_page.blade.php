{{-- Shared frame for legal pages: plain, readable prose. Expects $heading and $updated. --}}
<section class="pt-32 pb-10 bg-gradient-to-r from-pcg-blue-900 to-pcg-blue-800">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">{{ $heading }}</h1>
        <p class="text-gray-200">
            PCG app · PCG Peyer Memorial Congregation
            @if(!empty($updated))
                · Last updated {{ $updated }}
            @endif
        </p>
    </div>
</section>
<style>
    .legal h2 { font-size: 1.35rem; font-weight: 700; color: #1e3a8a; margin: 2rem 0 .6rem; }
    .legal p, .legal li { color: #374151; line-height: 1.7; }
    .legal ul { list-style: disc; padding-left: 1.4rem; margin: .5rem 0; }
    .legal a { color: #1d4ed8; text-decoration: underline; }
</style>
