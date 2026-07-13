@extends('dashboard.layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('dashboard.users.update', $user) }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500 @enderror">
            @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('email') border-red-500 @enderror">
            @error('email')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-8">
            <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">User Role</label>
            <select id="role" name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin - Full Access</option>
                <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>Editor - Content Management</option>
                <option value="viewer" {{ old('role', $user->role) === 'viewer' ? 'selected' : '' }}>Viewer - Read Only</option>
            </select>
            @error('role')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="bg-gray-50 p-4 rounded-lg mb-8 border border-gray-200">
            <p class="text-sm text-gray-700">
                <strong>Member since:</strong> {{ $user->created_at->format('F j, Y') }}
            </p>
            <p class="text-sm text-gray-700">
                <strong>Status:</strong> {{ $user->is_active ? '✓ Active' : '○ Inactive' }}
            </p>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-cyan-600 text-white px-6 py-2 rounded-lg hover:bg-cyan-700 transition">
                <i class="fas fa-save mr-2"></i> Update User
            </button>
            <a href="{{ route('dashboard.users.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
