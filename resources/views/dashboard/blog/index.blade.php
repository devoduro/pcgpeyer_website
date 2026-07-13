@extends('dashboard.layouts.app')

@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h3 class="text-xl font-bold text-gray-900">All Blog Posts</h3>
    <a href="{{ route('dashboard.blog.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
        <i class="fas fa-plus"></i> New Post
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Author</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Published</th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($posts as $post)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-sm text-gray-900">
                    <div class="font-semibold">{{ $post->title }}</div>
                    <div class="text-gray-500 text-xs">{{ Str::limit($post->excerpt, 50) }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $post->author }}</td>
                <td class="px-6 py-4 text-sm">
                    <form action="{{ route('dashboard.blog.toggle-publish', $post) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium transition {{ $post->published ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                            {{ $post->published ? '✓ Published' : '○ Draft' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not published' }}
                </td>
                <td class="px-6 py-4 text-center text-sm">
                    <div class="flex justify-center gap-3">
                        <a href="{{ route('dashboard.blog.edit', $post) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('dashboard.blog.destroy', $post) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this post?');">
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
                    <p class="mt-2">No blog posts yet. <a href="{{ route('dashboard.blog.create') }}" class="text-blue-600 hover:underline">Create one</a></p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $posts->links() }}
</div>
@endsection
