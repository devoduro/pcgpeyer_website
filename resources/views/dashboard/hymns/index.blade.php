@extends('dashboard.layouts.app')

@section('title', 'Hymns')
@section('page-title', 'Hymn Review')

@section('content')
<div class="mb-6 grid grid-cols-3 gap-4">
    <div class="bg-white rounded-lg shadow-md p-4"><div class="text-sm text-gray-500">Hymn files</div><div class="text-2xl font-bold">{{ $stats['total'] }}</div></div>
    <div class="bg-white rounded-lg shadow-md p-4"><div class="text-sm text-gray-500">Published</div><div class="text-2xl font-bold text-green-700">{{ $stats['published'] }}</div></div>
    <div class="bg-white rounded-lg shadow-md p-4"><div class="text-sm text-gray-500">Verses awaiting review</div><div class="text-2xl font-bold text-amber-600">{{ $stats['pending_verses'] }}</div></div>
</div>

<form method="GET" class="mb-6 flex flex-wrap gap-3 items-center">
    <input type="text" name="q" value="{{ $q }}" placeholder="Hymn number" class="px-4 py-2 border border-gray-300 rounded-lg w-40">
    <select name="filter" class="px-4 py-2 border border-gray-300 rounded-lg" onchange="this.form.submit()">
        @foreach(['all' => 'All', 'pending' => 'Needs review', 'ready' => 'Ready to publish', 'published' => 'Published', 'flagged' => 'Flagged for a reader'] as $key => $label)
            <option value="{{ $key }}" @selected($filter === $key)>{{ $label }}</option>
        @endforeach
    </select>
    <button class="bg-gray-800 text-white px-4 py-2 rounded-lg">Filter</button>
</form>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No.</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Author</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Source file</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Verses</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Review</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($hymns as $hymn)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-3 text-sm font-bold text-gray-900">{{ $hymn->number }}</td>
                <td class="px-6 py-3 text-sm text-gray-600">{{ $hymn->author ?? '—' }}</td>
                <td class="px-6 py-3 text-sm text-gray-600">
                    {{ $hymn->source_file }}
                    @if($hymn->import_notes)<span class="block text-xs text-amber-600">{{ $hymn->import_notes }}</span>@endif
                </td>
                <td class="px-6 py-3 text-sm text-gray-600">{{ $hymn->verses_count }}</td>
                <td class="px-6 py-3 text-sm">
                    @if($hymn->pending_count === 0)
                        <span class="text-green-700">All approved</span>
                    @else
                        <span class="text-amber-600">{{ $hymn->pending_count }} pending</span>
                        @if($hymn->flagged_count)<span class="text-xs text-red-600">({{ $hymn->flagged_count }} flagged)</span>@endif
                    @endif
                </td>
                <td class="px-6 py-3">
                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $hymn->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ ucfirst($hymn->status) }}</span>
                </td>
                <td class="px-6 py-3 text-center text-sm">
                    <div class="flex justify-center gap-3 items-center">
                        <a href="{{ route('dashboard.hymns.edit', $hymn) }}" class="text-blue-600 hover:text-blue-900" title="Review"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('dashboard.hymns.toggle-publish', $hymn) }}" method="POST">
                            @csrf
                            <button class="text-xs px-2 py-1 rounded border {{ $hymn->status === 'published' ? 'border-gray-400 text-gray-700' : 'border-green-600 text-green-700' }}">{{ $hymn->status === 'published' ? 'Unpublish' : 'Publish' }}</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-6 py-8 text-center text-gray-500">No hymns found. Run <code>php artisan hymns:import</code> first.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $hymns->links() }}</div>
@endsection
