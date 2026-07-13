@extends('dashboard.layouts.app')

@section('title', 'View Leadership Member - ' . $leadership->name)
@section('page-title', 'Leadership Member Details')

@section('content')
<div class="max-w-4xl">
    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">{{ $leadership->name }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('dashboard.leadership.edit', $leadership) }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('dashboard.leadership.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Back
            </a>
        </div>
    </div>

    <!-- Profile Card -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <div class="grid grid-cols-3 gap-8">
            <!-- Profile Image -->
            <div class="col-span-1 flex flex-col items-center">
                @if($leadership->image)
                    <img src="{{ asset('storage/' . $leadership->image) }}" alt="{{ $leadership->name }}" class="w-48 h-48 rounded-lg object-cover shadow-lg mb-4">
                @else
                    <div class="w-48 h-48 rounded-lg bg-gradient-to-br from-cyan-200 to-cyan-400 flex items-center justify-center text-white text-6xl font-bold shadow-lg mb-4">
                        {{ substr($leadership->name, 0, 1) }}
                    </div>
                @endif
                
                <!-- Status Badge -->
                <div class="mt-4">
                    @if($leadership->active)
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                            <i class="fas fa-check-circle mr-2"></i> Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gray-100 text-gray-600">
                            <i class="fas fa-times-circle mr-2"></i> Inactive
                        </span>
                    @endif
                </div>

                @if($leadership->is_current)
                    <span class="mt-2 inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r from-blue-600 to-purple-600 text-white">
                        <i class="fas fa-star mr-2"></i> Current Term
                    </span>
                @endif
            </div>

            <!-- Details -->
            <div class="col-span-2">
                <div class="space-y-6">
                    <!-- Title/Position -->
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Title/Position</p>
                        <p class="text-xl font-bold text-gray-900">{{ $leadership->title_text }}</p>
                        @if($leadership->title_id)
                            <p class="text-sm text-gray-600 mt-1">
                                <i class="fas fa-bookmark text-cyan-600"></i> 
                                {{ $leadership->titleRelation?->title ?? 'Custom' }}
                            </p>
                        @endif
                    </div>

                    <!-- Year -->
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Leadership Year</p>
                        <p class="text-lg font-semibold text-cyan-700">{{ $leadership->yearRange }}</p>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                        <p class="font-semibold text-gray-800 mb-3">Contact Information</p>
                        
                        @if($leadership->email)
                            <div class="flex items-center gap-3">
                                <i class="fas fa-envelope text-cyan-600 w-5"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Email</p>
                                    <p class="text-gray-800">{{ $leadership->email }}</p>
                                </div>
                            </div>
                        @endif

                        @if($leadership->phone)
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone text-cyan-600 w-5"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Phone</p>
                                    <p class="text-gray-800">{{ $leadership->phone }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Display Order -->
                    <div>
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Display Order</p>
                        <p class="text-gray-800">{{ $leadership->display_order }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biography -->
        @if($leadership->bio)
            <div class="mt-8 pt-8 border-t">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Biography</p>
                <div class="bg-gray-50 rounded-lg p-4 text-gray-700 whitespace-pre-wrap">
                    {{ $leadership->bio }}
                </div>
            </div>
        @endif

        <!-- Metadata -->
        <div class="mt-8 pt-8 border-t grid grid-cols-2 gap-6 text-sm">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Created</p>
                <p class="text-gray-800">{{ $leadership->created_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">Last Updated</p>
                <p class="text-gray-800">{{ $leadership->updated_at->format('F j, Y \a\t g:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Delete Button -->
    <div class="mt-6">
        <form action="{{ route('dashboard.leadership.destroy', $leadership) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition flex items-center gap-2">
                <i class="fas fa-trash"></i> Delete Member
            </button>
        </form>
    </div>
</div>
@endsection
