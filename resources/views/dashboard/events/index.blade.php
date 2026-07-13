@extends('dashboard.layouts.app')

@section('title', 'Events')
@section('page-title', 'Events Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Events</h3>
    <a href="{{ route('dashboard.events.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Event
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Event Title</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Location</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($events as $event)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $event->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $event->start_date->format('M d, Y H:i') }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $event->location ?? 'TBD' }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $event->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ $event->published ? '✓ Published' : '○ Draft' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('dashboard.events.edit', $event) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('dashboard.events.destroy', $event) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
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
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    No events yet. <a href="{{ route('dashboard.events.create') }}" class="text-blue-600 hover:underline">Create one</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $events->links() }}
</div>
@endsection
