@extends('dashboard.layouts.app')

@section('title', 'Contact Messages')
@section('page-title', 'Contact Submissions')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">From</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Subject</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($submissions as $submission)
            <tr class="hover:bg-gray-50 transition {{ $submission->status === 'new' ? 'bg-blue-50' : '' }}">
                <td class="px-6 py-4">
                    <div class="font-semibold text-gray-900">{{ $submission->name }}</div>
                    <div class="text-xs text-gray-500">{{ $submission->email }}</div>
                </td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $submission->subject }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-xs font-medium
                        {{ $submission->status === 'new' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $submission->status === 'read' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $submission->status === 'replied' ? 'bg-purple-100 text-purple-700' : '' }}
                        {{ $submission->status === 'resolved' ? 'bg-green-100 text-green-700' : '' }}
                    ">
                        {{ ucfirst($submission->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $submission->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('dashboard.contact.show', $submission) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye"></i>
                        </a>
                        <form action="{{ route('dashboard.contact.destroy', $submission) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
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
                    <p>No contact messages yet</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $submissions->links() }}
</div>
@endsection
