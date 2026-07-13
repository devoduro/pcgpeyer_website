@extends('dashboard.layouts.app')

@section('title', 'Contact Message')
@section('page-title', 'Contact Message Details')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="flex justify-between items-start mb-6 pb-6 border-b border-gray-200">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $submission->subject }}</h2>
                <p class="text-gray-600 mt-1">From: <strong>{{ $submission->name }}</strong></p>
                <p class="text-gray-600">{{ $submission->email }} @if($submission->phone) • {{ $submission->phone }} @endif</p>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-medium
                {{ $submission->status === 'new' ? 'bg-blue-100 text-blue-700' : '' }}
                {{ $submission->status === 'read' ? 'bg-yellow-100 text-yellow-700' : '' }}
                {{ $submission->status === 'replied' ? 'bg-purple-100 text-purple-700' : '' }}
                {{ $submission->status === 'resolved' ? 'bg-green-100 text-green-700' : '' }}
            ">
                {{ ucfirst($submission->status) }}
            </span>
        </div>

        <p class="text-sm text-gray-600 mb-6">Received: {{ $submission->created_at->format('F j, Y g:i A') }}</p>

        <div class="mb-8 bg-gray-50 p-6 rounded-lg">
            <p class="text-gray-700 whitespace-pre-wrap">{{ $submission->message }}</p>
        </div>

        @if($submission->admin_notes)
        <div class="bg-blue-50 p-4 rounded-lg mb-6 border-l-4 border-blue-600">
            <h4 class="font-semibold text-blue-900 mb-2">Reply Sent</h4>
            <p class="text-blue-800">{{ $submission->admin_notes }}</p>
        </div>
        @endif
    </div>

    <!-- Reply Form -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-reply text-blue-500 mr-2"></i> 
            {{ $submission->status === 'replied' ? 'Update Reply' : 'Send Reply' }}
        </h3>

        <form action="{{ route('dashboard.contact.reply', $submission) }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Your Reply</label>
                <textarea name="admin_notes" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('admin_notes') border-red-500 @enderror" placeholder="Type your reply message here...">{{ old('admin_notes', $submission->admin_notes) }}</textarea>
                @error('admin_notes')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-paper-plane mr-2"></i> Send Reply
                </button>

                <form action="{{ route('dashboard.contact.resolve', $submission) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-check mr-2"></i> Mark Resolved
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection
