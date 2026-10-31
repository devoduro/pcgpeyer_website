@extends('dashboard.layouts.app')

@section('title', 'Group Leaders')
@section('page-title', 'Group Leaders')

@section('content')
<p class="mb-6 text-gray-600 max-w-3xl">
    The executives of each fellowship, guild and singing group. They appear on the public
    <a href="{{ route('group-leadership.index') }}" target="_blank" class="text-red-600 hover:underline">Group Leaders</a>
    page and on the group's own page. Leaders marked hidden are kept here but not shown on the website.
</p>

<!-- Add a leader -->
<form action="{{ route('dashboard.group-leaders.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6 mb-8">
    @csrf
    <h3 class="text-lg font-bold text-gray-900 mb-4"><i class="fas fa-plus text-red-600 mr-2"></i>Add a leader</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 items-end">
        <div class="lg:col-span-2">
            <label for="new_ministry" class="block text-sm font-semibold text-gray-700 mb-1">Group</label>
            <select id="new_ministry" name="ministry_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                <option value="">Select a group</option>
                @foreach($ministries as $ministry)
                    <option value="{{ $ministry->id }}" @selected(old('ministry_id') == $ministry->id)>{{ $ministry->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="new_name" class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
            <input type="text" id="new_name" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
        </div>
        <div>
            <label for="new_position" class="block text-sm font-semibold text-gray-700 mb-1">Position</label>
            <input type="text" id="new_position" name="position" value="{{ old('position') }}" placeholder="e.g. President" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
        </div>
        <div>
            <label for="new_order" class="block text-sm font-semibold text-gray-700 mb-1">Order</label>
            <input type="number" id="new_order" name="display_order" value="{{ old('display_order', 0) }}" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
        </div>
        <div>
            <label for="new_photo" class="block text-sm font-semibold text-gray-700 mb-1">Photo</label>
            <input type="file" id="new_photo" name="photo" accept="image/*" class="w-full text-sm text-gray-600">
        </div>
    </div>
    <div class="mt-4 flex items-center justify-between">
        <label class="inline-flex items-center gap-2 text-sm text-gray-700">
            <input type="checkbox" name="active" value="1" checked class="rounded border-gray-300 text-red-600 focus:ring-red-500">
            Show on website
        </label>
        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">Add leader</button>
    </div>
</form>

<!-- Leaders by group -->
@forelse($groups as $group)
    <div id="group-{{ $group->id }}" class="bg-white rounded-lg shadow-md overflow-hidden mb-8 scroll-mt-24">
        <div class="px-6 py-4 bg-gray-100 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900">{{ $group->name }}</h3>
            <span class="text-sm text-gray-500">{{ $group->leaders->where('active', true)->count() }} shown · {{ $group->leaders->count() }} total</span>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($group->leaders as $leader)
                <div class="p-4 flex flex-col md:flex-row gap-4 {{ $leader->active ? '' : 'bg-amber-50' }}">
                    <img src="{{ $leader->photo_url }}" alt="{{ $leader->name }}" class="w-20 h-28 object-cover rounded-lg shrink-0">

                    <form action="{{ route('dashboard.group-leaders.update', $leader) }}" method="POST" enctype="multipart/form-data" class="flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-3 items-end">
                        @csrf
                        @method('PUT')
                        <div class="lg:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Name</label>
                            <input type="text" name="name" value="{{ $leader->name }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Position</label>
                            <input type="text" name="position" value="{{ $leader->position }}" placeholder="e.g. Secretary" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Order</label>
                            <input type="number" name="display_order" value="{{ $leader->display_order }}" min="0" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="inline-flex items-center gap-2 text-sm text-gray-700 py-2">
                                <input type="checkbox" name="active" value="1" @checked($leader->active) class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                Show
                            </label>
                        </div>
                        <div class="lg:col-span-4">
                            <label class="block text-xs font-semibold text-gray-500 mb-1">Replace photo</label>
                            <input type="file" name="photo" accept="image/*" class="w-full text-sm text-gray-600">
                        </div>
                        <div class="lg:col-span-2 flex gap-2 justify-end">
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition text-sm">Save</button>
                            <button type="submit" form="delete-leader-{{ $leader->id }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition text-sm">Remove</button>
                        </div>
                    </form>
                    <form id="delete-leader-{{ $leader->id }}" action="{{ route('dashboard.group-leaders.destroy', $leader) }}" method="POST" onsubmit="return confirm('Remove {{ addslashes($leader->name) }} from {{ addslashes($group->name) }}?')" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@empty
    <div class="bg-white rounded-lg shadow-md p-8 text-center text-gray-500">No group leaders yet. Add the first one above.</div>
@endforelse
@endsection
