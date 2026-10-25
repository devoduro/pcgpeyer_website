@extends('dashboard.layouts.app')

@php $editing = $devotional->exists; @endphp
@section('title', $editing ? 'Edit Devotional' : 'New Devotional')
@section('page-title', $editing ? 'Edit Devotional' : 'Create New Devotional')

@section('content')
@php $input = 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent'; @endphp
<div class="max-w-4xl">
    <form action="{{ $editing ? route('dashboard.devotionals.update', $devotional) : route('dashboard.devotionals.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-8">
        @csrf
        @if($editing) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="publish_date" class="block text-sm font-semibold text-gray-700 mb-2">Date</label>
                <input type="date" id="publish_date" name="publish_date" value="{{ old('publish_date', $devotional->publish_date?->format('Y-m-d')) }}" required class="{{ $input }}">
                @error('publish_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                <p class="text-xs text-gray-500 mt-1">One devotional per day. The app's day follows Ghana time.</p>
            </div>
            <div>
                <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">Author (optional)</label>
                <input type="text" id="author" name="author" value="{{ old('author', $devotional->author) }}" class="{{ $input }}">
            </div>
        </div>

        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $devotional->title) }}" required class="{{ $input }}">
            @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="scripture_reference" class="block text-sm font-semibold text-gray-700 mb-2">Scripture reference</label>
            <input type="text" id="scripture_reference" name="scripture_reference" value="{{ old('scripture_reference', $devotional->scripture_reference) }}" placeholder="John 3:16-21" required class="{{ $input }}">
            @error('scripture_reference')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="scripture_text" class="block text-sm font-semibold text-gray-700 mb-2">Scripture text (optional)</label>
            <textarea id="scripture_text" name="scripture_text" rows="3" class="{{ $input }}">{{ old('scripture_text', $devotional->scripture_text) }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Only paste text from a Bible translation you are licensed to display.</p>
        </div>

        <div class="mb-6">
            <label for="reflection" class="block text-sm font-semibold text-gray-700 mb-2">Reflection</label>
            <textarea id="reflection" name="reflection" rows="10" required class="{{ $input }}">{{ old('reflection', $devotional->reflection) }}</textarea>
            @error('reflection')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            <p class="text-xs text-gray-500 mt-1">Basic HTML such as &lt;p&gt; and &lt;b&gt; is shown in the app.</p>
        </div>

        <div class="mb-6">
            <label for="prayer" class="block text-sm font-semibold text-gray-700 mb-2">Prayer (optional)</label>
            <textarea id="prayer" name="prayer" rows="3" class="{{ $input }}">{{ old('prayer', $devotional->prayer) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="question" class="block text-sm font-semibold text-gray-700 mb-2">Reflection question (optional)</label>
            <input type="text" id="question" name="question" value="{{ old('question', $devotional->question) }}" class="{{ $input }}">
        </div>

        <label class="flex items-center mb-6">
            <input type="checkbox" name="published" value="1" {{ old('published', $devotional->published) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
            <span class="ml-2 text-sm text-gray-700">Published</span>
        </label>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-save mr-2"></i> {{ $editing ? 'Save Changes' : 'Create Devotional' }}
            </button>
            <a href="{{ route('dashboard.devotionals.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
