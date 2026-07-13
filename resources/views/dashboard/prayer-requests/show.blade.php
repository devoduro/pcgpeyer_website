@extends('dashboard.layouts.app')

@section('title', 'Prayer Request')
@section('page-title', 'Prayer Request Details')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow-md p-8 mb-6">
        <div class="flex justify-between items-start mb-6 pb-6 border-b border-gray-200">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $prayerRequest->name }}</h2>
                <p class="text-gray-600">{{ $prayerRequest->email }} @if($prayerRequest->phone) • {{ $prayerRequest->phone }} @endif</p>
            </div>
            <span class="px-4 py-2 rounded-full text-sm font-medium {{ $prayerRequest->is_answered ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ $prayerRequest->is_answered ? '✓ Answered' : 'Pending' }}
            </span>
        </div>

        <div class="mb-6">
            <p class="text-sm text-gray-600 mb-2">Category: <span class="font-semibold">{{ ucfirst($prayerRequest->category) }}</span></p>
            <p class="text-sm text-gray-600">Submitted: {{ $prayerRequest->created_at->format('F j, Y g:i A') }}</p>
        </div>

        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Prayer Request</h3>
            <p class="text-gray-700 whitespace-pre-wrap">{{ $prayerRequest->request }}</p>
        </div>

        @if($prayerRequest->admin_notes)
        <div class="bg-blue-50 p-4 rounded-lg mb-6 border-l-4 border-blue-600">
            <h4 class="font-semibold text-blue-900 mb-2">Admin Notes</h4>
            <p class="text-blue-800">{{ $prayerRequest->admin_notes }}</p>
        </div>
        @endif

        <div class="flex gap-4">
            @if(!$prayerRequest->is_answered)
            <form action="{{ route('dashboard.prayer-requests.mark-answered', $prayerRequest) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-check mr-2"></i> Mark as Answered
                </button>
            </form>
            @endif
        </div>
    </div>

    <!-- Add Notes -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">
            <i class="fas fa-sticky-note text-yellow-500 mr-2"></i> Admin Notes
        </h3>

        <form action="{{ route('dashboard.prayer-requests.notes', $prayerRequest) }}" method="POST">
            @csrf

            <div class="mb-6">
                <textarea name="admin_notes" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Add internal notes about this prayer request...">{{ old('admin_notes', $prayerRequest->admin_notes) }}</textarea>
                @error('admin_notes')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-save mr-2"></i> Save Notes
            </button>
        </form>
    </div>
</div>
@endsection
