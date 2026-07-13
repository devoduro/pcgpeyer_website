@extends('dashboard.layouts.app')

@section('title', 'Sermons')
@section('page-title', 'Sermons Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Sermons</h3>
    <a href="{{ route('dashboard.sermons.create') }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Sermon
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Preacher</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Featured</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($sermons as $sermon)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">{{ $sermon->title }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $sermon->preacher }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $sermon->sermon_date ? $sermon->sermon_date->format('M d, Y') : 'N/A' }}</td>
                <td class="px-6 py-4 text-sm">
                    <form action="{{ route('dashboard.sermons.toggle-featured', $sermon) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium transition {{ $sermon->featured ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            {{ $sermon->featured ? '★ Featured' : '☆ Not Featured' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('dashboard.sermons.edit', $sermon) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('dashboard.sermons.destroy', $sermon) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this sermon?');">
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
                    <p class="mt-2">No sermons yet. <a href="{{ route('dashboard.sermons.create') }}" class="text-blue-600 hover:underline">Add one</a></p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $sermons->links() }}
</div>
@endsection
