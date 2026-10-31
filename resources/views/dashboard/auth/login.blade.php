<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Sign in - PCG Peyer Memorial Dashboard</title>

    <link rel="icon" type="image/png" href="{{ asset('images/loader.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/dashboard.css'])
</head>
<body class="font-poppins antialiased bg-white text-gray-900">
<div class="min-h-screen grid lg:grid-cols-2">

    <!-- Photo panel -->
    <aside class="relative hidden lg:flex flex-col justify-between overflow-hidden bg-primary-900 text-white p-12">
        <img src="{{ asset('images/bantama/hero_church.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600/95 via-primary-800/90 to-primary-900/80"></div>

        <a href="{{ route('home') }}" class="relative flex items-center gap-3">
            <img src="{{ asset('images/pcg_logo.png') }}" alt="PCG crest" class="h-12 w-auto">
            <span class="leading-tight">
                <span class="block text-[11px] font-bold uppercase tracking-[.14em] text-red-300">Presbyterian Church of Ghana</span>
                <span class="block font-display text-xl font-extrabold">Peyer Memorial Congregation</span>
            </span>
        </a>

        <div class="relative max-w-md">
            <span class="inline-block w-12 h-1 rounded-full bg-red-600 mb-6"></span>
            <h1 class="font-display text-4xl font-extrabold leading-tight">Church dashboard</h1>
            <p class="mt-4 text-lg text-white/75 leading-relaxed">
                Publish sermons, news and events, keep leaders and groups up to date, and respond to prayer requests and messages.
            </p>
        </div>

        <p class="relative text-sm text-white/50">Bantama, Kumasi</p>
    </aside>

    <!-- Form panel -->
    <main class="flex flex-col justify-center px-6 py-12 sm:px-12 bg-gray-50 lg:bg-white">
        <div class="w-full max-w-sm mx-auto">
            <!-- Crest on small screens, where the photo panel is hidden -->
            <a href="{{ route('home') }}" class="lg:hidden flex items-center gap-3 mb-10">
                <img src="{{ asset('images/pcg_logo.png') }}" alt="PCG crest" class="h-11 w-auto">
                <span class="leading-tight">
                    <span class="block text-[10px] font-bold uppercase tracking-[.14em] text-red-600">Presbyterian Church of Ghana</span>
                    <span class="block font-display text-lg font-extrabold text-primary-600">Peyer Memorial</span>
                </span>
            </a>

            <h2 class="font-display text-3xl font-extrabold text-gray-900">Sign in</h2>
            <p class="mt-2 text-gray-500">Use the email and password for your dashboard account.</p>

            @if (session('success'))
                <div class="mt-6 flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    <i class="fas fa-circle-check mt-0.5"></i><span>{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="mt-6 flex items-start gap-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-800">
                    <i class="fas fa-circle-info mt-0.5"></i><span>{{ session('error') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}" class="mt-8 space-y-5" x-data="{ show: false, busy: false }" @submit="busy = true">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email address</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                               class="w-full h-12 pl-10 pr-4 rounded-xl border-gray-300 bg-white text-gray-900 focus:border-primary-500 focus:ring-primary-500 @error('email') border-red-500 @enderror"
                               placeholder="you@example.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 flex items-start gap-1.5"><i class="fas fa-circle-exclamation mt-0.5"></i>{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input :type="show ? 'text' : 'password'" type="password" id="password" name="password" required autocomplete="current-password"
                               class="w-full h-12 pl-10 pr-12 rounded-xl border-gray-300 bg-white text-gray-900 focus:border-primary-500 focus:ring-primary-500 @error('password') border-red-500 @enderror"
                               placeholder="Your password">
                        <button type="button" @click="show = !show" class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 rounded-lg text-gray-400 hover:text-primary-600 hover:bg-gray-100"
                                :aria-label="show ? 'Hide password' : 'Show password'">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-2.5 text-sm text-gray-600 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    Keep me signed in on this device
                </label>

                <button type="submit" :disabled="busy"
                        class="w-full h-12 rounded-xl bg-primary-600 text-white font-semibold shadow-brand hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition flex items-center justify-center gap-2 disabled:opacity-70">
                    <span x-show="!busy">Sign in</span>
                    <span x-show="busy" x-cloak><i class="fas fa-circle-notch fa-spin mr-1"></i> Signing in…</span>
                    <i class="fas fa-arrow-right text-sm" x-show="!busy"></i>
                </button>
            </form>

            <p class="mt-8 text-sm text-gray-500">
                Forgotten your password or need an account? Contact the dashboard administrator.
            </p>

            <a href="{{ route('home') }}" class="mt-10 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-red-600 transition-colors">
                <i class="fas fa-arrow-left text-xs"></i> Back to the website
            </a>
        </div>
    </main>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
</body>
</html>
