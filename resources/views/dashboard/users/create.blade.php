@extends('dashboard.layouts.app')

@section('title', 'Create User')
@section('page-title', 'Add New User')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('dashboard.users.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror">
            @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('email') border-red-500 @enderror">
            @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('password') border-red-500 @enderror" placeholder="Min. 8 characters">
                @error('password')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
            </div>
        </div>

        <div class="mb-8">
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">User Role</label>
            <select id="role" name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                <option value="">Select a role</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin - Full Access</option>
                <option value="editor" {{ old('role') === 'editor' ? 'selected' : '' }}>Editor - Content Management</option>
                <option value="viewer" {{ old('role') === 'viewer' ? 'selected' : '' }}>Viewer - Read Only</option>
            </select>
            @error('role')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="bg-blue-50 p-4 rounded-lg mb-8 border border-blue-200">
            <h4 class="font-semibold text-blue-900 mb-2"><i class="fas fa-info-circle mr-2"></i> Role Permissions</h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li><strong>Admin:</strong> Can manage users, all content, and system settings</li>
                <li><strong>Editor:</strong> Can create and edit content (posts, sermons, events, etc.)</li>
                <li><strong>Viewer:</strong> Read-only access to dashboard</li>
            </ul>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition">
                <i class="fas fa-user-plus mr-2"></i> Create User
            </button>
            <a href="{{ route('dashboard.users.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
