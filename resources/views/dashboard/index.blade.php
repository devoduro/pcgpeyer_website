@extends('dashboard.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('hide-page-header', true)

@php
    $user = auth()->user();
    $hour = now()->hour;
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');

    // Things someone should look at, most pressing first. Only editors can act on them.
    $attention = $user->isEditor() ? array_values(array_filter([
        $stats['contact_messages'] ? ['fa-envelope', $stats['contact_messages'] . ' new ' . Str::plural('message', $stats['contact_messages']), 'From the contact form', route('dashboard.contact.index')] : null,
        $stats['prayer_requests'] ? ['fa-hands', $stats['prayer_requests'] . ' open prayer ' . Str::plural('request', $stats['prayer_requests']), 'Not yet marked as prayed for', route('dashboard.prayer-requests.index')] : null,
        ! $todaysDevotional ? ['fa-book-bible', 'No devotion for today', 'App users get a morning devotion each day', route('dashboard.devotionals.create', ['date' => today()->toDateString()])] : null,
        $stats['unnamed_group_leaders'] ? ['fa-user-tag', $stats['unnamed_group_leaders'] . ' group ' . Str::plural('leader', $stats['unnamed_group_leaders']) . ' hidden', 'Add their names to show them on the site', route('dashboard.group-leaders.index')] : null,
        ! $stats['upcoming_events'] ? ['fa-calendar-plus', 'No upcoming events', 'The website events page is empty', route('dashboard.events.create')] : null,
    ])) : [];

    $tiles = [
        ['Sermons', $stats['sermons'], 'fa-bible', 'dashboard.sermons.index'],
        ['News posts', $stats['posts'], 'fa-newspaper', 'dashboard.blog.index'],
        ['Upcoming events', $stats['upcoming_events'], 'fa-calendar-days', 'dashboard.events.index'],
        ['Ministries', $stats['ministries'], 'fa-hands-praying', 'dashboard.ministries.index'],
        ['Group leaders', $stats['group_leaders'], 'fa-people-group', 'dashboard.group-leaders.index'],
        ['App users', $stats['app_users'], 'fa-mobile-screen', null],
    ];

    $actions = [
        ['New sermon', 'fa-bible', 'dashboard.sermons.create'],
        ['News post', 'fa-newspaper', 'dashboard.blog.create'],
        ['Event', 'fa-calendar-plus', 'dashboard.events.create'],
        ['Devotion', 'fa-book-bible', 'dashboard.devotionals.create'],
        ['Announcement', 'fa-bullhorn', 'dashboard.announcements.create'],
        ['Photo album', 'fa-images', 'dashboard.galleries.create'],
    ];
@endphp

@section('content')
<div class="space-y-6">
    <!-- Greeting -->
    <section class="relative overflow-hidden rounded-2xl bg-primary-900 text-white">
        <img src="{{ asset('images/bantama/hero_church.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/95 via-primary-800/90 to-primary-900/70"></div>
        <div class="relative px-6 py-8 md:px-10 md:py-10 flex flex-col md:flex-row md:items-end md:justify-between gap-6">
            <div>
                <p class="text-sm font-semibold text-red-300">{{ now()->format('l, j F Y') }}</p>
                <h1 class="font-display text-3xl md:text-4xl font-extrabold mt-1">{{ $greeting }}, {{ Str::before($user->name, ' ') ?: $user->name }}</h1>
                <p class="mt-2 text-white/75">
                    @if($attention)
                        {{ count($attention) }} {{ Str::plural('thing', count($attention)) }} could use your attention today.
                    @else
                        Everything is up to date. Thank you for serving.
                    @endif
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 h-11 px-5 rounded-xl bg-white/10 border border-white/25 hover:bg-white/20 font-semibold text-sm transition">
                    <i class="fas fa-arrow-up-right-from-square text-xs"></i> View website
                </a>
                @if($user->isEditor())
                <a href="{{ route('dashboard.sermons.create') }}" class="inline-flex items-center gap-2 h-11 px-5 rounded-xl bg-red-600 hover:bg-red-700 font-semibold text-sm shadow-accent transition">
                    <i class="fas fa-plus text-xs"></i> Add a sermon
                </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Numbers -->
    <section class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">
        @foreach($tiles as [$label, $value, $icon, $route])
            @php $link = $route && $user->isEditor() ? route($route) : null; @endphp
            <{{ $link ? 'a' : 'div' }} @if($link) href="{{ $link }}" @endif
                class="group bg-white rounded-2xl border border-gray-200 p-5 shadow-card {{ $link ? 'hover:border-primary-300 hover:shadow-lift transition' : '' }}">
                <div class="flex items-center justify-between">
                    <span class="w-10 h-10 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center"><i class="fas {{ $icon }}"></i></span>
                    @if($link)<i class="fas fa-arrow-right text-xs text-gray-300 group-hover:text-red-600 transition"></i>@endif
                </div>
                <p class="mt-4 text-3xl font-bold text-gray-900 tabular-nums">{{ number_format($value) }}</p>
                <p class="text-sm text-gray-500">{{ $label }}</p>
            </{{ $link ? 'a' : 'div' }}>
        @endforeach
    </section>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-start">
        <!-- Main column -->
        <div class="xl:col-span-2 space-y-6">
            @if($attention)
            <section class="bg-white rounded-2xl border border-gray-200 shadow-card">
                <header class="px-6 py-4 border-b border-gray-100">
                    <h2 class="font-bold text-gray-900">Needs attention</h2>
                </header>
                <ul class="divide-y divide-gray-100">
                    @foreach($attention as [$icon, $title, $note, $url])
                        <li>
                            <a href="{{ $url }}" class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition group">
                                <span class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shrink-0"><i class="fas {{ $icon }}"></i></span>
                                <span class="flex-1 min-w-0">
                                    <span class="block font-semibold text-gray-900">{{ $title }}</span>
                                    <span class="block text-sm text-gray-500">{{ $note }}</span>
                                </span>
                                <i class="fas fa-chevron-right text-xs text-gray-300 group-hover:text-primary-600 transition"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>
            @endif

            <!-- Upcoming events -->
            <section class="bg-white rounded-2xl border border-gray-200 shadow-card">
                <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-900">Upcoming events</h2>
                    @if($user->isEditor())
                        <a href="{{ route('dashboard.events.index') }}" class="text-sm font-semibold text-primary-600 hover:text-red-600">All events</a>
                    @endif
                </header>
                @forelse($upcomingEvents as $event)
                    <div class="flex items-center gap-4 px-6 py-4 {{ $loop->last ? '' : 'border-b border-gray-100' }}">
                        <div class="w-14 shrink-0 rounded-xl bg-primary-50 text-center py-2">
                            <p class="text-[11px] font-bold uppercase text-red-600">{{ $event->start_date->format('M') }}</p>
                            <p class="text-xl font-bold text-primary-600 leading-none">{{ $event->start_date->format('j') }}</p>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 truncate">{{ $event->title }}</p>
                            <p class="text-sm text-gray-500 truncate">
                                {{ $event->start_date->format('D, g:i A') }}@if($event->location) · {{ $event->location }}@endif
                            </p>
                        </div>
                        @unless($event->published)
                            <span class="badge badge-warning">Draft</span>
                        @endunless
                        @if($user->isEditor())
                            <a href="{{ route('dashboard.events.edit', $event) }}" class="text-gray-400 hover:text-primary-600 p-2" title="Edit"><i class="fas fa-pen text-sm"></i></a>
                        @endif
                    </div>
                @empty
                    <div class="px-6 py-10 text-center">
                        <i class="fas fa-calendar text-3xl text-gray-300"></i>
                        <p class="mt-3 text-gray-500">No upcoming events scheduled.</p>
                        @if($user->isEditor())
                            <a href="{{ route('dashboard.events.create') }}" class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-red-600"><i class="fas fa-plus text-xs"></i> Add an event</a>
                        @endif
                    </div>
                @endforelse
            </section>

            @if($user->isEditor())
            <!-- Inbox -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <section class="bg-white rounded-2xl border border-gray-200 shadow-card">
                    <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="font-bold text-gray-900">Latest messages</h2>
                        <a href="{{ route('dashboard.contact.index') }}" class="text-sm font-semibold text-primary-600 hover:text-red-600">Inbox</a>
                    </header>
                    @forelse($recentMessages as $message)
                        <a href="{{ route('dashboard.contact.show', $message) }}" class="block px-6 py-3.5 hover:bg-gray-50 transition {{ $loop->last ? '' : 'border-b border-gray-100' }}">
                            <div class="flex items-center gap-2">
                                @if($message->status === 'new')<span class="w-2 h-2 rounded-full bg-red-600 shrink-0" title="New"></span>@endif
                                <p class="font-semibold text-gray-900 truncate flex-1">{{ $message->name }}</p>
                                <span class="text-xs text-gray-400 shrink-0">{{ $message->created_at->diffForHumans(null, true) }}</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate">{{ $message->subject ?: Str::limit($message->message, 60) }}</p>
                        </a>
                    @empty
                        <p class="px-6 py-8 text-center text-sm text-gray-500">No messages yet.</p>
                    @endforelse
                </section>

                <section class="bg-white rounded-2xl border border-gray-200 shadow-card">
                    <header class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="font-bold text-gray-900">Open prayer requests</h2>
                        <a href="{{ route('dashboard.prayer-requests.index') }}" class="text-sm font-semibold text-primary-600 hover:text-red-600">All</a>
                    </header>
                    @forelse($recentPrayers as $prayer)
                        <a href="{{ route('dashboard.prayer-requests.show', $prayer) }}" class="block px-6 py-3.5 hover:bg-gray-50 transition {{ $loop->last ? '' : 'border-b border-gray-100' }}">
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-gray-900 truncate flex-1">{{ $prayer->is_private ? 'Private request' : ($prayer->name ?: 'Anonymous') }}</p>
                                <span class="text-xs text-gray-400 shrink-0">{{ $prayer->created_at->diffForHumans(null, true) }}</span>
                            </div>
                            <p class="text-sm text-gray-500 truncate">{{ $prayer->category ? Str::headline($prayer->category) . ' · ' : '' }}{{ Str::limit($prayer->request, 60) }}</p>
                        </a>
                    @empty
                        <p class="px-6 py-8 text-center text-sm text-gray-500">No open prayer requests.</p>
                    @endforelse
                </section>
            </div>
            @endif
        </div>

        <!-- Side column -->
        <aside class="space-y-6">
            @if($user->isEditor())
            <section class="bg-white rounded-2xl border border-gray-200 shadow-card p-6">
                <h2 class="font-bold text-gray-900 mb-4">Create</h2>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($actions as [$label, $icon, $route])
                        <a href="{{ route($route) }}" class="group flex flex-col items-center justify-center gap-2 rounded-xl border border-gray-200 py-4 px-2 text-center hover:border-primary-300 hover:bg-primary-50 transition">
                            <i class="fas {{ $icon }} text-lg text-primary-600 group-hover:text-red-600 transition"></i>
                            <span class="text-sm font-semibold text-gray-700">{{ $label }}</span>
                        </a>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Today's devotion -->
            <section class="bg-white rounded-2xl border border-gray-200 shadow-card p-6">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-bold text-gray-900">Today's devotion</h2>
                    @if($todaysDevotional)
                        <span class="badge {{ $todaysDevotional->published ? 'badge-success' : 'badge-warning' }}">{{ $todaysDevotional->published ? 'Published' : 'Draft' }}</span>
                    @endif
                </div>
                @if($todaysDevotional)
                    <p class="text-lg font-semibold text-gray-900 leading-snug">{{ $todaysDevotional->title }}</p>
                    @if($todaysDevotional->scripture_reference)
                        <p class="text-sm text-red-600 font-semibold mt-1">{{ $todaysDevotional->scripture_reference }}</p>
                    @endif
                    @if($user->isEditor())
                        <a href="{{ route('dashboard.devotionals.edit', $todaysDevotional) }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-red-600">Edit devotion <i class="fas fa-arrow-right text-xs"></i></a>
                    @endif
                @else
                    <p class="text-sm text-gray-500">Nothing is scheduled for today.</p>
                    @if($user->isEditor())
                        <a href="{{ route('dashboard.devotionals.create', ['date' => today()->toDateString()]) }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-red-600"><i class="fas fa-plus text-xs"></i> Write today's devotion</a>
                    @endif
                @endif
            </section>

            <!-- Library -->
            <section class="bg-white rounded-2xl border border-gray-200 shadow-card p-6">
                <h2 class="font-bold text-gray-900 mb-4">Library</h2>
                <dl class="space-y-3 text-sm">
                    @foreach([['Videos', $stats['videos'], 'fa-video'], ['Gallery items', $stats['gallery_items'], 'fa-images'], ['All events', $stats['events'], 'fa-calendar'], ['Church leaders', $stats['leadership'], 'fa-user-tie']] as [$label, $value, $icon])
                        <div class="flex items-center justify-between">
                            <dt class="flex items-center gap-3 text-gray-600"><i class="fas {{ $icon }} w-4 text-center text-gray-400"></i>{{ $label }}</dt>
                            <dd class="font-bold text-gray-900 tabular-nums">{{ number_format($value) }}</dd>
                        </div>
                    @endforeach
                    @if($user->isAdmin())
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <dt class="flex items-center gap-3 text-gray-600"><i class="fas fa-users-cog w-4 text-center text-gray-400"></i>Dashboard users</dt>
                            <dd><a href="{{ route('dashboard.users.index') }}" class="font-bold text-primary-600 hover:text-red-600 tabular-nums">{{ $stats['active_users'] }}</a></dd>
                        </div>
                    @endif
                </dl>
            </section>
        </aside>
    </div>
</div>
@endsection
