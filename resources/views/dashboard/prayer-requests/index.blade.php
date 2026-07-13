@extends('dashboard.layouts.app')

@section('title', 'Prayer Requests')
@section('page-title', 'Prayer Requests')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Category</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($requests as $request)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $request->name }}</div>
                    <div class="text-xs text-gray-500">{{ $request->email }}</div>
                </td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs">{{ ucfirst($request->category) }}</span>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $request->is_answered ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $request->is_answered ? '✓ Answered' : 'Pending' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $request->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('dashboard.prayer-requests.show', $request) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('dashboard.prayer-requests.destroy', $request) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
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
                    <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
                    <p>No prayer requests yet</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $requests->links() }}
</div>
@endsection
