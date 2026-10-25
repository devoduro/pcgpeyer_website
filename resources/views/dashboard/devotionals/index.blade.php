@extends('dashboard.layouts.app')

@section('title', 'Devotionals')
@section('page-title', 'Devotionals Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">Daily Devotionals</h3>
    <a href="{{ route('dashboard.devotionals.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Devotional
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Scripture</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Completed</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($devotionals as $devotional)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-600">{{ $devotional->publish_date->format('D, M d, Y') }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $devotional->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $devotional->scripture_reference }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $devotional->completions_count }}</td>
                <td class="px-6 py-4">
                    <form action="{{ route('dashboard.devotionals.toggle-publish', $devotional) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium {{ $devotional->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $devotional->published ? '✓ Published' : '○ Draft' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('dashboard.devotionals.edit', $devotional) }}" class="text-blue-600 hover:text-blue-900"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('dashboard.devotionals.destroy', $devotional) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                    No devotionals yet. <a href="{{ route('dashboard.devotionals.create') }}" class="text-blue-600 hover:underline">Create one</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $devotionals->links() }}</div>
@endsection
