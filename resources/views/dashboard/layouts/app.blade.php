<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PCG Peyer Memorial Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/loader.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/loader.png') }}">

    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Compiled Tailwind CSS -->
    @vite(['resources/css/dashboard.css'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>
<body class="font-poppins antialiased bg-gray-50">
    <div
        x-data="{ sidebarOpen: false, sidebarCollapsed: localStorage.getItem('dashSidebarCollapsed') === 'true' }"
        class="min-h-screen flex"
    >
        <!-- Mobile overlay -->
        <div
            x-cloak
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/40 md:hidden"
        ></div>

        <!-- Sidebar -->
        <aside
            x-cloak
            :class="{
                'translate-x-0': sidebarOpen,
                '-translate-x-full': !sidebarOpen,
                'md:w-20': sidebarCollapsed,
                'md:w-64': !sidebarCollapsed,
                'sidebar-collapsed': sidebarCollapsed,
            }"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-primary-900 shadow-lg transform transition-all duration-300 ease-in-out md:translate-x-0 md:sticky md:top-0 md:h-screen md:shadow-none flex-shrink-0 overflow-y-auto overflow-x-hidden"
        >
            <!-- Collapse toggle (desktop only) -->
            <button
                @click="sidebarCollapsed = !sidebarCollapsed; localStorage.setItem('dashSidebarCollapsed', sidebarCollapsed)"
                class="hidden md:flex absolute -right-3 top-20 w-6 h-6 items-center justify-center rounded-full bg-white border border-gray-300 shadow-sm text-gray-500 hover:text-primary-600 hover:border-primary-300 transition-colors z-10"
                :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'"
            >
                <i class="fas text-[10px]" :class="sidebarCollapsed ? 'fa-chevron-right' : 'fa-chevron-left'"></i>
            </button>

            <!-- Logo -->
            <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 h-16 px-5 border-b border-white/10 overflow-hidden" :class="sidebarCollapsed ? 'md:justify-center md:px-2' : ''">
                <img src="{{ asset('images/pcg_logo.png') }}" alt="PCG crest" class="h-9 w-auto shrink-0">
                <span class="leading-tight whitespace-nowrap" x-show="!sidebarCollapsed" x-cloak>
                    <span class="block font-display text-[15px] font-extrabold text-white">Peyer Memorial</span>
                    <span class="block text-[11px] font-semibold uppercase tracking-[.12em] text-red-300">Dashboard</span>
                </span>
            </a>

            <!-- Navigation -->
            <nav id="dash-nav" class="p-4 space-y-1">
                <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.index') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>

                @if(auth()->user()->isEditor())
                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-white/40" x-show="!sidebarCollapsed" x-cloak>Content</p>

                <a href="{{ route('dashboard.blog.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.blog.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>News / Blog</span>
                </a>

                <a href="{{ route('dashboard.sermons.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.sermons.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-bible w-5"></i>
                    <span>Sermons</span>
                </a>

                <a href="{{ route('dashboard.ministries.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.ministries.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-hands-praying w-5"></i>
                    <span>Ministries</span>
                </a>

                <a href="{{ route('dashboard.events.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.events.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-calendar-days w-5"></i>
                    <span>Events</span>
                </a>

                <a href="{{ route('dashboard.devotionals.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.devotionals.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-book-bible w-5"></i>
                    <span>Devotionals</span>
                </a>

                <a href="{{ route('dashboard.hymns.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.hymns.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-music w-5"></i>
                    <span>Hymns</span>
                </a>

                <a href="{{ route('dashboard.announcements.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.announcements.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-bullhorn w-5"></i>
                    <span>Announcements</span>
                </a>

                <a href="{{ route('dashboard.galleries.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.galleries.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-images w-5"></i>
                    <span>Gallery</span>
                </a>

                <a href="{{ route('dashboard.videos.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.videos.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-video w-5"></i>
                    <span>Videos</span>
                </a>

                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-white/40" x-show="!sidebarCollapsed" x-cloak>Leadership</p>

                <div x-data="{ open: {{ request()->routeIs('dashboard.leadership.*') || request()->routeIs('dashboard.group-leaders.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.leadership.*') || request()->routeIs('dashboard.group-leaders.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-user-tie w-5"></i>
                            <span>Leadership</span>
                        </span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="open" x-transition class="pl-8 space-y-1">
                        <a href="{{ route('dashboard.leadership.index') }}" class="block px-4 py-2 text-sm text-white/70 hover:text-white rounded-lg {{ request()->routeIs('dashboard.leadership.index') || request()->routeIs('dashboard.leadership.create') || request()->routeIs('dashboard.leadership.edit') ? 'text-white font-semibold' : '' }}">
                            Leadership Members
                        </a>
                        <a href="{{ route('dashboard.group-leaders.index') }}" class="block px-4 py-2 text-sm text-white/70 hover:text-white rounded-lg {{ request()->routeIs('dashboard.group-leaders.*') ? 'text-white font-semibold' : '' }}">
                            Group Leaders
                        </a>
                        <a href="{{ route('dashboard.leadership.manage-years') }}" class="block px-4 py-2 text-sm text-white/70 hover:text-white rounded-lg {{ request()->routeIs('dashboard.leadership.manage-years') ? 'text-white font-semibold' : '' }}">
                            Manage Years
                        </a>
                        <a href="{{ route('dashboard.leadership.manage-titles') }}" class="block px-4 py-2 text-sm text-white/70 hover:text-white rounded-lg {{ request()->routeIs('dashboard.leadership.manage-titles') ? 'text-white font-semibold' : '' }}">
                            Manage Titles
                        </a>
                    </div>
                </div>

                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-white/40" x-show="!sidebarCollapsed" x-cloak>Communications</p>

                <a href="{{ route('dashboard.prayer-requests.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.prayer-requests.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-hands w-5"></i>
                    <span>Prayer Requests</span>
                    @php $unansweredPrayers = \App\Models\PrayerRequest::unanswered()->count(); @endphp
                    @if($unansweredPrayers > 0)
                        <span class="ml-auto bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full" x-show="!sidebarCollapsed" x-cloak>{{ $unansweredPrayers }}</span>
                    @endif
                </a>

                <a href="{{ route('dashboard.contact.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.contact.*') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-envelope w-5"></i>
                    <span>Contact Submissions</span>
                    @php $newContacts = \App\Models\ContactSubmission::unread()->count(); @endphp
                    @if($newContacts > 0)
                        <span class="ml-auto bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full" x-show="!sidebarCollapsed" x-cloak>{{ $newContacts }}</span>
                    @endif
                </a>
                @endif

                @if(auth()->user()->isAdmin())
                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-white/40" x-show="!sidebarCollapsed" x-cloak>Administration</p>

                <a href="{{ route('dashboard.users.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.users.index') || request()->routeIs('dashboard.users.create') || request()->routeIs('dashboard.users.edit') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-users-cog w-5"></i>
                    <span>Users</span>
                </a>

                <a href="{{ route('dashboard.users.logs') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.users.logs') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-history w-5"></i>
                    <span>Activity Logs</span>
                </a>
                @endif

                <p class="px-4 mt-6 mb-2 text-xs font-bold uppercase tracking-wider text-white/40" x-show="!sidebarCollapsed" x-cloak>Account</p>

                <a href="{{ route('dashboard.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-white/10 hover:text-white rounded-lg {{ request()->routeIs('dashboard.profile') ? 'bg-white/10 text-white font-semibold' : '' }}">
                    <i class="fas fa-user w-5"></i>
                    <span>Profile</span>
                </a>

                <form method="POST" action="{{ route('dashboard.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-white/70 transition-all duration-200 hover:bg-red-600/20 hover:text-red-200 rounded-lg">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Navigation -->
            <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-30">
                <div class="flex items-center justify-between h-14 px-4 md:px-6">
                    <!-- Mobile Menu Button -->
                    <button
                        @click="sidebarOpen = !sidebarOpen"
                        class="text-gray-600 md:hidden focus:outline-none"
                    >
                        <i class="fas fa-bars text-lg"></i>
                    </button>

                    <!-- Page Title - Mobile -->
                    <div class="md:hidden font-semibold text-lg text-gray-800">
                        @yield('page-title', 'Dashboard')
                    </div>

                    <!-- Jump to a dashboard section (searches the sidebar links) -->
                    <div class="hidden md:flex md:flex-1 md:max-w-md"
                         x-data="{
                            q: '', i: 0, open: false, pages: [],
                            init() {
                                this.pages = [...document.querySelectorAll('#dash-nav a[href]')]
                                    .map(a => ({ label: a.textContent.trim().replace(/\s+\d+$/, ''), href: a.href }))
                                    .filter((p, n, all) => p.label && all.findIndex(o => o.href === p.href) === n);
                            },
                            get matches() {
                                const q = this.q.trim().toLowerCase();
                                return q ? this.pages.filter(p => p.label.toLowerCase().includes(q)).slice(0, 8) : [];
                            },
                            go() { const m = this.matches[this.i]; if (m) window.location = m.href; }
                         }"
                         @keydown.window.ctrl.k.prevent="$refs.jump.focus()"
                         @click.away="open = false">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input
                                x-ref="jump" x-model="q" type="text" autocomplete="off"
                                @focus="open = true" @input="open = true; i = 0"
                                @keydown.arrow-down.prevent="i = Math.min(i + 1, matches.length - 1)"
                                @keydown.arrow-up.prevent="i = Math.max(i - 1, 0)"
                                @keydown.enter.prevent="go()" @keydown.escape="open = false; $el.blur()"
                                class="w-full py-2 pl-10 pr-16 text-sm text-gray-700 bg-gray-100 border-0 rounded-lg focus:bg-white focus:ring-2 focus:ring-primary-500 focus:outline-none"
                                placeholder="Jump to… (sermons, events, users)"
                            >
                            <kbd class="absolute right-3 top-1/2 -translate-y-1/2 text-[10px] font-semibold text-gray-400 border border-gray-300 rounded px-1.5 py-0.5">Ctrl K</kbd>
                            <div x-show="open && q" x-cloak x-transition.opacity class="absolute left-0 right-0 mt-2 bg-white border border-gray-200 rounded-xl shadow-lift overflow-hidden z-40">
                                <template x-for="(m, n) in matches" :key="m.href">
                                    <a :href="m.href" @mouseenter="i = n" class="flex items-center justify-between px-4 py-2.5 text-sm" :class="n === i ? 'bg-primary-50 text-primary-600' : 'text-gray-700'">
                                        <span x-text="m.label"></span>
                                        <i class="fas fa-arrow-turn-down rotate-90 text-xs text-gray-400" x-show="n === i"></i>
                                    </a>
                                </template>
                                <p x-show="!matches.length" class="px-4 py-3 text-sm text-gray-500">No section called “<span x-text="q"></span>”.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Navigation -->
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" target="_blank" class="hidden sm:inline-flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-primary-600" title="Open the public website in a new tab">
                            <i class="fas fa-arrow-up-right-from-square text-xs"></i> <span class="hidden lg:inline">View site</span>
                        </a>

                        <!-- Notifications -->
                        @if(auth()->user()->isEditor())
                        <div x-data="{ open: false }" class="relative">
                            <button
                                @click="open = !open"
                                class="relative p-2 text-gray-600 transition-colors duration-200 rounded-full hover:bg-gray-100 hover:text-primary-600 focus:outline-none"
                            >
                                <i class="fas fa-bell"></i>
                                @php $notifCount = $unansweredPrayers + $newContacts; @endphp
                                @if($notifCount > 0)
                                    <span class="absolute -top-0.5 -right-0.5 w-4 h-4 flex items-center justify-center bg-red-500 text-white text-[10px] font-bold rounded-full">{{ $notifCount > 9 ? '9+' : $notifCount }}</span>
                                @endif
                            </button>

                            <div
                                x-show="open"
                                @click.away="open = false"
                                x-transition
                                x-cloak
                                class="absolute right-0 z-10 w-80 mt-2 origin-top-right bg-white border border-gray-200 rounded-lg shadow-lg"
                            >
                                <div class="p-3 border-b border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-700">Notifications</h3>
                                </div>
                                <div class="max-h-64 overflow-y-auto divide-y divide-gray-100">
                                    @if($newContacts > 0)
                                        <a href="{{ route('dashboard.contact.index') }}" class="block p-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-envelope text-primary-500 mr-2"></i>
                                            {{ $newContacts }} new contact {{ Str::plural('submission', $newContacts) }}
                                        </a>
                                    @endif
                                    @if($unansweredPrayers > 0)
                                        <a href="{{ route('dashboard.prayer-requests.index') }}" class="block p-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <i class="fas fa-hands text-primary-500 mr-2"></i>
                                            {{ $unansweredPrayers }} unanswered prayer {{ Str::plural('request', $unansweredPrayers) }}
                                        </a>
                                    @endif
                                    @if($notifCount === 0)
                                        <div class="p-4 text-sm text-gray-500">No new notifications</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- User Menu -->
                        <div x-data="{ open: false }" class="relative">
                            <button
                                @click="open = !open"
                                class="flex items-center space-x-2 focus:outline-none"
                            >
                                <div class="w-8 h-8 overflow-hidden rounded-full gradient-bg flex items-center justify-center text-white font-bold text-sm">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="hidden md:block text-left leading-tight">
                                    <span class="block text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</span>
                                    <span class="block text-xs text-gray-500">{{ ucfirst(auth()->user()->role) }}</span>
                                </span>
                                <i class="hidden md:block fas fa-chevron-down text-xs text-gray-400"></i>
                            </button>

                            <div
                                x-show="open"
                                @click.away="open = false"
                                x-transition
                                x-cloak
                                class="absolute right-0 z-10 w-48 mt-2 origin-top-right bg-white border border-gray-200 rounded-lg shadow-lg"
                            >
                                <div class="p-2">
                                    <a href="{{ route('dashboard.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-600 rounded-md">
                                        <i class="fas fa-user-circle mr-2"></i> Profile
                                    </a>
                                    <hr class="my-1 border-gray-200">
                                    <form method="POST" action="{{ route('dashboard.logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-primary-600 rounded-md">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 flex flex-col px-4 md:px-8 py-6">
                <!-- Alerts -->
                @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-lg animate-fade-in">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <strong>Errors occurred:</strong>
                    <ul class="mt-2 ml-4 list-disc">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session()->has('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 p-3 bg-green-50 border-l-4 border-green-500 text-green-700 flex justify-between items-center rounded-r-lg animate-fade-in">
                    <div>
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif

                @if (session()->has('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 flex justify-between items-center rounded-r-lg animate-fade-in">
                    <div>
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                    <button @click="show = false" class="text-red-700 hover:text-red-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif

                <!-- Page Header (a page with its own heading sets hide-page-header) -->
                @unless(View::hasSection('hide-page-header'))
                <div class="mb-6">
                    <h1 class="font-display text-2xl md:text-[28px] font-extrabold text-gray-900 tracking-tight">@yield('page-title', 'Dashboard')</h1>
                </div>
                @endunless

                <!-- Content -->
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="py-4 px-6 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} PCG Peyer Memorial Congregation. All rights reserved.
                    </p>
                    <div class="mt-2 md:mt-0">
                        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-primary-600">View Public Site</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @yield('scripts')
    @stack('scripts')
</body>
</html>
