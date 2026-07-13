@extends('dashboard.layouts.app')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')

@section('content')
<!-- Header -->
<div class="mb-6 flex justify-between items-center flex-wrap gap-4">
    <div>
        <h3 class="text-2xl font-bold text-gray-900">Activity Logs</h3>
        <p class="text-sm text-gray-600 mt-1">Track all user activities and system changes</p>
    </div>
    <a href="{{ route('dashboard.users.index') }}" class="bg-gray-600 text-white px-6 py-2.5 rounded-lg hover:bg-gray-700 transition flex items-center gap-2 shadow-md">
        <i class="fas fa-arrow-left"></i> Back to Users
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-md p-6 mb-6">
    <form method="GET" action="{{ route('dashboard.users.logs') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">User</label>
            <select name="user_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                <option value="">All Users</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Action</label>
            <select name="action" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                <option value="">All Actions</option>
                @foreach($actions as $action)
                <option value="{{ $action }}" {{ request('action') === $action ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $action)) }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">From Date</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">To Date</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
        </div>
        <div class="flex items-end gap-2">
            <button type="submit" class="flex-1 bg-cyan-600 text-white px-4 py-2 rounded-lg hover:bg-cyan-700 transition">
                <i class="fas fa-filter mr-2"></i>Filter
            </button>
            <a href="{{ route('dashboard.users.logs') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                <i class="fas fa-redo"></i>
            </a>
        </div>
    </form>
</div>

<!-- Activity Logs -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Time</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">User</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Action</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Description</th>
                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">IP Address</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-gray-900">{{ $log->created_at->format('M d, Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $log->created_at->format('h:i:s A') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($log->user)
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white font-bold text-xs">
                                {{ strtoupper(substr($log->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $log->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $log->user->email }}</div>
                            </div>
                        </div>
                        @else
                        <span class="text-sm text-gray-400 italic">System</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold
                            {{ in_array($log->action, ['created', 'logged_in']) ? 'bg-green-100 text-green-700' : '' }}
                            {{ in_array($log->action, ['updated', 'status_changed']) ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ in_array($log->action, ['deleted', 'logged_out']) ? 'bg-red-100 text-red-700' : '' }}
                            {{ !in_array($log->action, ['created', 'updated', 'deleted', 'logged_in', 'logged_out', 'status_changed']) ? 'bg-gray-100 text-gray-700' : '' }}
                        ">
                            {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $log->description }}</div>
                        @if($log->model_type)
                        <div class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-tag mr-1"></i>{{ class_basename($log->model_type) }}
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600">{{ $log->ip_address ?? 'N/A' }}</div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-history text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg">No activity logs found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $logs->links() }}
</div>
@endsection
