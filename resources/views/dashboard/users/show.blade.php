@extends('dashboard.layouts.app')

@section('title', 'User Profile')
@section('page-title', 'User Profile')

@section('content')
<!-- Header -->
<div class="mb-6 flex justify-between items-center flex-wrap gap-4">
    <div>
        <h3 class="text-2xl font-bold text-gray-900">User Profile</h3>
        <p class="text-sm text-gray-600 mt-1">View user details and activity history</p>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('dashboard.users.index') }}" class="bg-gray-600 text-white px-6 py-2.5 rounded-lg hover:bg-gray-700 transition flex items-center gap-2 shadow-md">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <a href="{{ route('dashboard.users.edit', $user) }}" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 py-2.5 rounded-lg hover:from-blue-700 hover:to-cyan-700 transition flex items-center gap-2 shadow-md">
            <i class="fas fa-edit"></i> Edit User
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- User Info Card -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Profile Header -->
            <div class="bg-gradient-to-br from-cyan-500 to-blue-600 p-8 text-center">
                <div class="w-24 h-24 mx-auto rounded-full bg-white flex items-center justify-center text-cyan-600 font-bold text-3xl shadow-lg">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <h3 class="text-2xl font-bold text-white mt-4">{{ $user->name }}</h3>
                <p class="text-cyan-100 text-sm mt-1">{{ $user->email }}</p>
            </div>

            <!-- User Details -->
            <div class="p-6 space-y-4">
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase">Role</label>
                    <div class="mt-1">
                        <span class="px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm inline-block
                            {{ $user->role === 'admin' ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white' : '' }}
                            {{ $user->role === 'editor' ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white' : '' }}
                            {{ $user->role === 'viewer' ? 'bg-gray-200 text-gray-700' : '' }}
                        ">
                            <i class="fas {{ $user->role === 'admin' ? 'fa-crown' : ($user->role === 'editor' ? 'fa-pen' : 'fa-eye') }} mr-1"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                @if($user->phone)
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase">Phone</label>
                    <p class="text-gray-900 font-medium mt-1">
                        <i class="fas fa-phone text-cyan-600 mr-2"></i>{{ $user->phone }}
                    </p>
                </div>
                @endif

                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase">Status</label>
                    <div class="mt-1">
                        <span class="px-3 py-1.5 rounded-lg text-xs font-bold inline-block {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            <i class="fas {{ $user->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>

                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase">Member Since</label>
                    <p class="text-gray-900 font-medium mt-1">
                        <i class="fas fa-calendar text-cyan-600 mr-2"></i>{{ $user->created_at->format('M d, Y') }}
                    </p>
                </div>

                @if($user->last_login_at)
                <div>
                    <label class="text-xs font-semibold text-gray-500 uppercase">Last Login</label>
                    <p class="text-gray-900 font-medium mt-1">
                        <i class="fas fa-clock text-cyan-600 mr-2"></i>{{ $user->last_login_at->format('M d, Y h:i A') }}
                    </p>
                    @if($user->last_login_ip)
                    <p class="text-xs text-gray-500 mt-1">IP: {{ $user->last_login_ip }}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <!-- Permissions Card -->
        @if($user->permissions && count($user->permissions) > 0)
        <div class="bg-white rounded-xl shadow-md p-6 mt-6">
            <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-shield-alt text-cyan-600"></i>
                Permissions
            </h4>
            <div class="space-y-2">
                @foreach($user->permissions as $permission)
                <div class="flex items-center gap-2 text-sm">
                    <i class="fas fa-check text-green-600"></i>
                    <span class="text-gray-700">{{ \App\Models\User::getAvailablePermissions()[$permission] ?? ucfirst(str_replace('_', ' ', $permission)) }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Recent Activity -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <h4 class="font-bold text-gray-900 flex items-center gap-2">
                    <i class="fas fa-history text-cyan-600"></i>
                    Recent Activity
                </h4>
            </div>
            <div class="p-6">
                @if($recentActivity->count() > 0)
                <div class="space-y-4">
                    @foreach($recentActivity as $activity)
                    <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-0">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center
                                {{ in_array($activity->action, ['created', 'logged_in']) ? 'bg-green-100' : '' }}
                                {{ in_array($activity->action, ['updated', 'status_changed']) ? 'bg-blue-100' : '' }}
                                {{ in_array($activity->action, ['deleted', 'logged_out']) ? 'bg-red-100' : '' }}
                                {{ !in_array($activity->action, ['created', 'updated', 'deleted', 'logged_in', 'logged_out', 'status_changed']) ? 'bg-gray-100' : '' }}
                            ">
                                <i class="fas 
                                    {{ in_array($activity->action, ['created']) ? 'fa-plus text-green-600' : '' }}
                                    {{ in_array($activity->action, ['updated', 'status_changed']) ? 'fa-edit text-blue-600' : '' }}
                                    {{ in_array($activity->action, ['deleted']) ? 'fa-trash text-red-600' : '' }}
                                    {{ in_array($activity->action, ['logged_in']) ? 'fa-sign-in-alt text-green-600' : '' }}
                                    {{ in_array($activity->action, ['logged_out']) ? 'fa-sign-out-alt text-red-600' : '' }}
                                    {{ !in_array($activity->action, ['created', 'updated', 'deleted', 'logged_in', 'logged_out', 'status_changed']) ? 'fa-circle text-gray-600' : '' }}
                                "></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-gray-900">{{ $activity->description }}</p>
                            <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                <span><i class="fas fa-clock mr-1"></i>{{ $activity->created_at->diffForHumans() }}</span>
                                @if($activity->ip_address)
                                <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $activity->ip_address }}</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                {{ in_array($activity->action, ['created', 'logged_in']) ? 'bg-green-100 text-green-700' : '' }}
                                {{ in_array($activity->action, ['updated', 'status_changed']) ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ in_array($activity->action, ['deleted', 'logged_out']) ? 'bg-red-100 text-red-700' : '' }}
                                {{ !in_array($activity->action, ['created', 'updated', 'deleted', 'logged_in', 'logged_out', 'status_changed']) ? 'bg-gray-100 text-gray-700' : '' }}
                            ">
                                {{ ucfirst(str_replace('_', ' ', $activity->action)) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <i class="fas fa-history text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">No recent activity</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
