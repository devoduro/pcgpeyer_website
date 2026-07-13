@extends('dashboard.layouts.app')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <!-- Profile Card -->
    <div class="md:col-span-1">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-4xl font-bold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ auth()->user()->name }}</h2>
            <p class="text-gray-600 mb-4">{{ auth()->user()->email }}</p>
            <div class="bg-blue-50 p-3 rounded-lg mb-4">
                <p class="text-sm text-gray-700">
                    <strong>Role:</strong> <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded text-xs font-semibold">{{ ucfirst(auth()->user()->role) }}</span>
                </p>
                <p class="text-sm text-gray-700 mt-2">
                    <strong>Member since:</strong> {{ auth()->user()->created_at->format('F j, Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="md:col-span-2 space-y-6">
        <!-- Update Profile -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-user text-blue-600 mr-2"></i> Update Profile
            </h3>

            <form action="{{ route('dashboard.profile.update') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
            </form>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-lock text-red-600 mr-2"></i> Change Password
            </h3>

            <form action="{{ route('dashboard.password.change') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('current_password') border-red-500 @enderror">
                    @error('current_password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                        <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('password') border-red-500 @enderror" placeholder="Min. 8 characters">
                        @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                </div>

                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-key mr-2"></i> Update Password
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
