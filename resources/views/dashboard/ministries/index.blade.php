@extends('dashboard.layouts.app')

@section('title', 'Ministries')
@section('page-title', 'Ministries Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Ministries</h3>
    <a href="{{ route('dashboard.ministries.create') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Ministry
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Leader</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Active</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($ministries as $ministry)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $ministry->name }}</div>
                    <div class="text-xs text-gray-500">{{ Str::limit($ministry->description, 40) }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $ministry->leader ?? 'N/A' }}</td>
                <td class="px-6 py-4">
                    <form action="{{ route('dashboard.ministries.toggle-active', $ministry) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium transition {{ $ministry->active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            {{ $ministry->active ? '✓ Active' : '○ Inactive' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('dashboard.ministries.edit', $ministry) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('dashboard.ministries.destroy', $ministry) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                    No ministries yet. <a href="{{ route('dashboard.ministries.create') }}" class="text-blue-600 hover:underline">Create one</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $ministries->links() }}
</div>
@endsection
