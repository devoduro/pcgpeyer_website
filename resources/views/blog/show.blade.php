@extends('layouts.app')

@section('title', $post->title . ' - PCG Monninger Congregation')

@section('content')
<section class="pt-32 pb-16 bg-gradient-to-r from-pcg-blue-900 to-pcg-red-700 text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-sm mb-4">
            <a href="{{ route('news-update') }}" class="text-gray-200 hover:text-white">← Back to News Update</a>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $post->title }}</h1>
        <div class="flex items-center text-gray-200">
            <span class="mr-4">By {{ $post->author }}</span>
            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Recent' }}</span>
        </div>
    </div>
</section>

<article class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            @if($post->image)
            <div class="h-96 rounded-xl mb-8 overflow-hidden">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<div class=\'h-96 bg-gradient-to-br from-pcg-blue-500 to-pcg-red-500 rounded-xl flex items-center justify-center\'><svg class=\'w-32 h-32 text-white opacity-50\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z\'/></svg></div>'">
            </div>
            @else
            <div class="h-96 bg-gradient-to-br from-pcg-blue-500 to-pcg-red-500 rounded-xl mb-8 flex items-center justify-center">
                <svg class="w-32 h-32 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            @endif

            <div class="text-gray-700 text-lg leading-relaxed space-y-6">
                @php
                    // Convert URLs to clickable links
                    $content = e($post->content);
                    $content = preg_replace(
                        '#(https?://[^\s<]+)#i',
                        '<a href="$1" target="_blank" rel="noopener noreferrer" class="text-pcg-blue-600 hover:text-pcg-red-600 underline font-semibold transition-colors duration-300">$1</a>',
                        $content
                    );
                    $content = nl2br($content);
                @endphp
                {!! $content !!}
            </div>
        </div>

        @if($relatedPosts && $relatedPosts->count() > 0)
        <div class="mt-16 pt-8 border-t border-gray-200">
            <h3 class="text-2xl font-bold text-pcg-blue-900 mb-6">Related Posts</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedPosts as $related)
                <a href="{{ route('news-update.show', $related->slug) }}" class="group">
                    <div class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-lg transition">
                        <div class="h-40 bg-gradient-to-br from-pcg-blue-400 to-pcg-red-400"></div>
                        <div class="p-4">
                            <h4 class="font-bold text-pcg-blue-900 group-hover:text-pcg-blue-700 transition">{{ $related->title }}</h4>
                            <p class="text-sm text-gray-600 mt-2">{{ Str::limit($related->excerpt, 80) }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-12 pt-8 border-t border-gray-200">
            <a href="{{ route('news-update') }}" class="btn-secondary">
                ← Back to All Posts
            </a>
        </div>
    </div>
</article>
@endsection
