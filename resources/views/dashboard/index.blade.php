@extends('dashboard.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Home')

@section('content')
<div class="space-y-6">
    <!-- Premium Welcome Header -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 rounded-3xl shadow-2xl transform hover:scale-[1.01] transition-transform duration-500">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
        
        <!-- Decorative Elements with Animation -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -mr-48 -mt-48 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full -ml-32 -mb-32 animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-1/2 w-32 h-32 bg-white/5 rounded-full -ml-16 -mt-16 animate-ping" style="animation-duration: 3s;"></div>
        
        <div class="relative px-8 py-10">
            <div class="flex items-center justify-between flex-wrap gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/30">
                            <i class="fas fa-crown text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-white tracking-tight">
                                Welcome back, {{ auth()->user()->name }}
                            </h1>
                            <p class="text-white/80 text-lg mt-1">
                                <i class="fas fa-shield-check mr-2"></i>{{ ucfirst(auth()->user()->role) }} Access
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <div class="bg-white/10 backdrop-blur-xl rounded-2xl px-6 py-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                        <p class="text-white/70 text-sm font-medium mb-1"><i class="fas fa-calendar-day mr-2"></i>Today</p>
                        <p class="text-white text-xl font-bold">{{ now()->format('M d, Y') }}</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-xl rounded-2xl px-6 py-4 border border-white/20 hover:bg-white/20 transition-all duration-300 hover:scale-105">
                        <p class="text-white/70 text-sm font-medium mb-1"><i class="fas fa-clock mr-2"></i>Time</p>
                        <p class="text-white text-xl font-bold" id="current-time">{{ now()->format('h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
        <!-- Left Section - Content & Management -->
        <div class="xl:col-span-9 space-y-6">
            <!-- Content & Church Management Combined -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Content Management -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-5 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg animate-pulse" style="animation-duration: 2s;">
                                    <i class="fas fa-edit text-white"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900">Content</h2>
                                    <p class="text-xs text-gray-600">Manage your content</p>
                                </div>
                            </div>
                            <div class="px-3 py-1 bg-blue-100 rounded-full">
                                <span class="text-xs font-bold text-blue-600">{{ $stats['posts'] + $stats['sermons'] + ($stats['videos'] ?? 0) + $stats['gallery_items'] }} Total</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-3">
                            <!-- Blog Posts -->
                            <a href="{{ route('dashboard.blog.index') }}" class="group relative bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl p-4 border-2 border-blue-200/50 hover:border-blue-400 hover:shadow-lg transition-all duration-300">
                                <div class="absolute top-2 right-2 w-10 h-10 bg-blue-500/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-newspaper text-blue-600 text-lg"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide">Blog</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['posts'] }}</p>
                                    <p class="text-xs text-blue-600 font-medium">View all</p>
                                </div>
                            </a>

                            <!-- Sermons -->
                            <a href="{{ route('dashboard.sermons.index') }}" class="group relative bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-xl p-4 border-2 border-purple-200/50 hover:border-purple-400 hover:shadow-lg transition-all duration-300">
                                <div class="absolute top-2 right-2 w-10 h-10 bg-purple-500/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-microphone text-purple-600 text-lg"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-semibold text-purple-600 uppercase tracking-wide">Sermons</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['sermons'] }}</p>
                                    <p class="text-xs text-purple-600 font-medium">View all</p>
                                </div>
                            </a>

                            <!-- Videos -->
                            <a href="{{ route('dashboard.videos.index') }}" class="group relative bg-gradient-to-br from-indigo-50 to-indigo-100/50 rounded-xl p-4 border-2 border-indigo-200/50 hover:border-indigo-400 hover:shadow-lg transition-all duration-300">
                                <div class="absolute top-2 right-2 w-10 h-10 bg-indigo-500/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-video text-indigo-600 text-lg"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">Videos</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['videos'] ?? 0 }}</p>
                                    <p class="text-xs text-indigo-600 font-medium">View all</p>
                                </div>
                            </a>

                            <!-- Gallery -->
                            <a href="{{ route('dashboard.galleries.index') }}" class="group relative bg-gradient-to-br from-yellow-50 to-yellow-100/50 rounded-xl p-4 border-2 border-yellow-200/50 hover:border-yellow-400 hover:shadow-lg transition-all duration-300">
                                <div class="absolute top-2 right-2 w-10 h-10 bg-yellow-500/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-images text-yellow-600 text-lg"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-semibold text-yellow-600 uppercase tracking-wide">Gallery</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['gallery_items'] }}</p>
                                    <p class="text-xs text-yellow-600 font-medium">View all</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Church Management -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-5 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg animate-pulse" style="animation-duration: 2s; animation-delay: 0.5s;">
                                    <i class="fas fa-church text-white"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900">Church</h2>
                                    <p class="text-xs text-gray-600">Manage church programs</p>
                                </div>
                            </div>
                            <div class="px-3 py-1 bg-red-100 rounded-full">
                                <span class="text-xs font-bold text-red-600">{{ $stats['ministries'] + $stats['leadership'] }} Active</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-3">
                            <!-- Ministries -->
                            <a href="{{ route('dashboard.ministries.index') }}" class="group relative bg-gradient-to-br from-red-50 to-red-100/50 rounded-xl p-4 border-2 border-red-200/50 hover:border-red-400 hover:shadow-lg transition-all duration-300">
                                <div class="absolute top-2 right-2 w-10 h-10 bg-red-500/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-hands-praying text-red-600 text-lg"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-semibold text-red-600 uppercase tracking-wide">Ministries</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['ministries'] }}</p>
                                    <p class="text-xs text-red-600 font-medium">Manage</p>
                                </div>
                            </a>

                            <!-- Leadership -->
                            <a href="{{ route('dashboard.leadership.index') }}" class="group relative bg-gradient-to-br from-cyan-50 to-cyan-100/50 rounded-xl p-4 border-2 border-cyan-200/50 hover:border-cyan-400 hover:shadow-lg transition-all duration-300">
                                <div class="absolute top-2 right-2 w-10 h-10 bg-cyan-500/10 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fas fa-user-tie text-cyan-600 text-lg"></i>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-xs font-semibold text-cyan-600 uppercase tracking-wide">Leadership</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $stats['leadership'] }}</p>
                                    <p class="text-xs text-cyan-600 font-medium">Manage</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Messages & System Management -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Contact Messages -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-5 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg relative">
                                    <i class="fas fa-envelope text-white"></i>
                                    @if($stats['contact_messages'] > 0)
                                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold animate-bounce">{{ $stats['contact_messages'] }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900">Messages</h2>
                                    <p class="text-xs text-gray-600">Connect with congregation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <a href="{{ route('dashboard.contact.index') }}" class="group relative bg-gradient-to-br from-indigo-50 to-indigo-100/50 rounded-xl p-6 border-2 border-indigo-200/50 hover:border-indigo-400 hover:shadow-lg transition-all duration-300 flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">New Messages</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['contact_messages'] }}</p>
                                <p class="text-xs text-indigo-600 font-medium">View messages</p>
                            </div>
                            <div class="w-16 h-16 bg-indigo-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-envelope text-indigo-600 text-2xl"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- System Management -->
                @if(auth()->user()->isAdmin())
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="bg-gradient-to-r from-gray-50 to-slate-50 px-6 py-5 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-gray-600 to-gray-800 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-cog text-white animate-spin" style="animation-duration: 3s;"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-900">System</h2>
                                    <p class="text-xs text-gray-600">Administrator</p>
                                </div>
                            </div>
                            <div class="px-3 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full">
                                <span class="text-xs font-bold text-white">ADMIN</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <a href="{{ route('dashboard.users.index') }}" class="group relative bg-gradient-to-br from-gray-50 to-gray-100/50 rounded-xl p-6 border-2 border-gray-200/50 hover:border-gray-400 hover:shadow-lg transition-all duration-300 flex items-center justify-between">
                            <div class="space-y-1">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Active Users</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['active_users'] }}</p>
                                <p class="text-xs text-gray-600 font-medium">Manage users</p>
                            </div>
                            <div class="w-16 h-16 bg-gray-500/10 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="fas fa-users text-gray-600 text-2xl"></i>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </div>

        <!-- Right Section - Quick Actions -->
        <div class="xl:col-span-3 space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden sticky top-6">
                <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-6 py-5 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-bolt text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Quick Actions</h3>
                            <p class="text-sm text-gray-600">Create new content</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 space-y-3">
                    <a href="{{ route('dashboard.blog.create') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100/30 rounded-xl border-2 border-blue-200/50 hover:border-blue-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">New Blog Post</p>
                            <p class="text-xs text-gray-600">Create article</p>
                        </div>
                        <i class="fas fa-chevron-right text-blue-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('dashboard.sermons.create') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-purple-50 to-purple-100/30 rounded-xl border-2 border-purple-200/50 hover:border-purple-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">New Sermon</p>
                            <p class="text-xs text-gray-600">Add message</p>
                        </div>
                        <i class="fas fa-chevron-right text-purple-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('dashboard.events.create') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-green-50 to-green-100/30 rounded-xl border-2 border-green-200/50 hover:border-green-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">New Event</p>
                            <p class="text-xs text-gray-600">Schedule event</p>
                        </div>
                        <i class="fas fa-chevron-right text-green-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('dashboard.ministries.create') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-red-50 to-red-100/30 rounded-xl border-2 border-red-200/50 hover:border-red-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">New Ministry</p>
                            <p class="text-xs text-gray-600">Add ministry</p>
                        </div>
                        <i class="fas fa-chevron-right text-red-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('dashboard.leadership.create') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-cyan-50 to-cyan-100/30 rounded-xl border-2 border-cyan-200/50 hover:border-cyan-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-cyan-500 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">New Leader</p>
                            <p class="text-xs text-gray-600">Add member</p>
                        </div>
                        <i class="fas fa-chevron-right text-cyan-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('dashboard.leadership.manage-years') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-cyan-50 to-cyan-100/30 rounded-xl border-2 border-cyan-200/50 hover:border-cyan-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-cyan-500/60 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-calendar text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">Manage Years</p>
                            <p class="text-xs text-gray-600">Edit leadership years</p>
                        </div>
                        <i class="fas fa-chevron-right text-cyan-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('dashboard.leadership.manage-titles') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-cyan-50 to-cyan-100/30 rounded-xl border-2 border-cyan-200/50 hover:border-cyan-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-cyan-500/60 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-briefcase text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">Manage Titles</p>
                            <p class="text-xs text-gray-600">Edit leadership titles</p>
                        </div>
                        <i class="fas fa-chevron-right text-cyan-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="{{ route('dashboard.galleries.create') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-yellow-50 to-yellow-100/30 rounded-xl border-2 border-yellow-200/50 hover:border-yellow-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">New Gallery</p>
                            <p class="text-xs text-gray-600">Create album</p>
                        </div>
                        <i class="fas fa-chevron-right text-yellow-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard.users.create') }}" class="group flex items-center gap-4 p-4 bg-gradient-to-r from-gray-50 to-gray-100/30 rounded-xl border-2 border-gray-200/50 hover:border-gray-400 hover:shadow-lg transition-all">
                        <div class="w-12 h-12 bg-gray-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900">New User</p>
                            <p class="text-xs text-gray-600">Add admin</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-600 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Help Card -->
            <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-xl p-6 text-white hover:shadow-2xl transition-all duration-300 transform hover:scale-105 relative overflow-hidden">
                <!-- Animated Background -->
                <div class="absolute inset-0 bg-white/5 animate-pulse" style="animation-duration: 3s;"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-xl rounded-xl flex items-center justify-center border border-white/30 animate-bounce" style="animation-duration: 2s;">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold">Need Help?</h3>
                    </div>
                    <p class="text-white/90 text-sm leading-relaxed mb-4">
                        All your content management tools are available in the left sidebar. Navigate through sections to manage your church's digital presence.
                    </p>
                    <div class="bg-white/10 backdrop-blur-xl rounded-xl p-4 border border-white/20 hover:bg-white/20 transition-all duration-300">
                        <p class="text-white/70 text-xs font-medium mb-1"><i class="fas fa-user-shield mr-2"></i>Your Role</p>
                        <p class="text-white text-lg font-bold">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Statistics Summary Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Overview</h3>
                            <p class="text-xs text-gray-600">Quick stats</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gradient-to-r from-blue-50 to-blue-100/30 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-newspaper text-white text-xs"></i>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Total Posts</span>
                        </div>
                        <span class="text-lg font-bold text-blue-600">{{ $stats['posts'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50 to-purple-100/30 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-purple-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-microphone text-white text-xs"></i>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Sermons</span>
                        </div>
                        <span class="text-lg font-bold text-purple-600">{{ $stats['sermons'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-gradient-to-r from-red-50 to-red-100/30 rounded-lg">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-hands-praying text-white text-xs"></i>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Ministries</span>
                        </div>
                        <span class="text-lg font-bold text-red-600">{{ $stats['ministries'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Live Clock Update
    function updateTime() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        const displayHours = hours % 12 || 12;
        const displayMinutes = minutes < 10 ? '0' + minutes : minutes;
        
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = displayHours + ':' + displayMinutes + ' ' + ampm;
        }
    }
    
    // Update time every second
    setInterval(updateTime, 1000);
    updateTime(); // Initial call
</script>
@endpush

@endsection
