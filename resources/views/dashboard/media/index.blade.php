@extends('dashboard.layouts.app')

@section('title', 'Media Gallery')
@section('page-title', 'Gallery Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">Gallery Items</h3>
    <a href="{{ route('dashboard.media.create') }}" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> Upload Image
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($items as $item)
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
        <div class="relative aspect-square bg-gray-100 overflow-hidden group">
            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition">
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-40 transition flex items-center justify-center gap-2">
                <a href="{{ route('dashboard.media.edit', $item) }}" class="bg-blue-600 text-white p-2 rounded-full hover:bg-blue-700">
                    <i class="fas fa-edit"></i>
                </a>
                <form action="{{ route('dashboard.media.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="p-4">
            <h4 class="font-semibold text-gray-900 text-sm truncate">{{ $item->title }}</h4>
            <p class="text-xs text-gray-600 mb-2">{{ $item->category }}</p>
            <div class="flex items-center justify-between text-xs">
                <span class="text-gray-500">{{ $item->uploaded_by ?? 'Admin' }}</span>
                <form action="{{ route('dashboard.media.toggle-featured', $item) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="text-yellow-500 hover:text-yellow-600">
                        <i class="fas {{ $item->featured ? 'fa-star' : 'fa-star-o' }}"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-500">
        <i class="fas fa-image text-4xl mb-4 opacity-50"></i>
        <p>No images yet. <a href="{{ route('dashboard.media.create') }}" class="text-blue-600 hover:underline">Upload one</a></p>
    </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $items->links() }}
</div>
@endsection
