<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Presbyterian Church of Ghana - Rev. Friedrich Monninger Congregation, Akosombo">
    <title>@yield('title', 'PCG Monninger Congregation')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/pcg_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/loadpcg_logoer.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')</head>
<body class="bg-gray-50">
    <div id="page-loader" class="fixed inset-0 z-[9999] bg-gradient-to-br from-pcg-blue-900 to-pcg-red-900 flex items-center justify-center transition-opacity duration-500">
        <div class="flex flex-col items-center">
            <img src="{{ asset('images/loader.png') }}" alt="PCG Logo" class="w-24 h-24 animate-pulse">
            <div class="mt-6 text-white text-sm tracking-widest uppercase">Rev. Friedrich Monninger Congregation</div>
        </div>
    </div>
    @include('partials.navigation')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <!-- AOS Animation Library JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        if (window.AOS) {
          window.AOS.init({ duration: 800, easing: 'ease-out-quart', once: true, offset: 60 });
        }
      });
    </script>
    
    @stack('scripts')
</body>
</html>
