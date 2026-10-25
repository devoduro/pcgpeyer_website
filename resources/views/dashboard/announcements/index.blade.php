@extends('dashboard.layouts.app')

@section('title', 'Announcements')
@section('page-title', 'Announcements Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Announcements</h3>
    <a href="{{ route('dashboard.announcements.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Announcement
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Type</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Window</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($announcements as $announcement)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                    @if($announcement->pinned)<i class="fas fa-thumbtack text-pcg-red-500 mr-1" title="Pinned"></i>@endif
                    {{ $announcement->title }}
                </td>
                <td class="px-6 py-4 text-sm">
                    <span @class([
                        'px-3 py-1 rounded-full text-xs font-medium',
                        'bg-blue-100 text-blue-700' => $announcement->type === 'info',
                        'bg-red-100 text-red-700' => $announcement->type === 'urgent',
                        'bg-purple-100 text-purple-700' => $announcement->type === 'event',
                    ])>{{ ucfirst($announcement->type) }}</span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    {{ $announcement->starts_at?->format('M d, Y') ?? 'Now' }}
                    &rarr;
                    {{ $announcement->expires_at?->format('M d, Y') ?? 'No expiry' }}
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('dashboard.announcements.toggle-publish', $announcement) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium {{ $announcement->published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $announcement->published ? '✓ Published' : '○ Draft' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('dashboard.announcements.edit', $announcement) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('dashboard.announcements.destroy', $announcement) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
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
                    No announcements yet. <a href="{{ route('dashboard.announcements.create') }}" class="text-blue-600 hover:underline">Create one</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $announcements->links() }}
</div>
@endsection
