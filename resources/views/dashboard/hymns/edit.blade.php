@extends('dashboard.layouts.app')

@section('title', 'Review Hymn ' . $hymn->number)
@section('page-title', 'Review Hymn ' . $hymn->number)

@section('content')
@php $langs = \App\Models\Hymn::LANGUAGES; @endphp
<div class="mb-4 text-sm text-gray-600">
    Source: <strong>{{ $hymn->source_file }}</strong>
    @if(\App\Http\Controllers\Dashboard\HymnController::sourcePath($hymn))
        <a href="{{ route('dashboard.hymns.source', $hymn) }}" class="ml-2 inline-flex items-center gap-1 text-blue-600 hover:underline">
            <i class="fas fa-file-powerpoint"></i> Download original slides
        </a>
    @endif
    @if($hymn->import_notes)<span class="block text-amber-600">{{ $hymn->import_notes }}</span>@endif
    <br>
    Edit the text where the extraction is wrong, tick <em>Approved</em> when a verse is correct, then save.
    The original extracted text is shown under each box and is never changed.
    Do not invent missing words: leave a verse unapproved if you are unsure.
</div>

<form action="{{ route('dashboard.hymns.update', $hymn) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-lg shadow-md p-4">
        <label class="block text-sm font-semibold text-gray-700 mb-2" for="author">Author / composer line</label>
        <input id="author" name="author" value="{{ old('author', $hymn->author) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
    </div>

    @forelse($rows as $position => $verses)
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="text-xs text-gray-500 mb-2">Slide {{ $position }}</div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach($langs as $code => $name)
                    @foreach($verses->where('language', $code) as $verse)
                        <div class="border rounded-lg p-3 {{ $verse->flags ? 'border-amber-400' : 'border-gray-200' }}">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-semibold">{{ $name }}</span>
                                <input name="verses[{{ $verse->id }}][label]" value="{{ old("verses.{$verse->id}.label", $verse->label) }}" class="text-xs px-2 py-1 border border-gray-300 rounded w-24" placeholder="Verse 1">
                            </div>
                            @if($verse->flags)
                                <div class="text-xs text-amber-700 mb-1">Check: {{ str_replace('_', ' ', $verse->flags) }}</div>
                            @endif
                            <textarea name="verses[{{ $verse->id }}][text]" rows="7" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>{{ old("verses.{$verse->id}.text", $verse->text) }}</textarea>
                            @error("verses.{$verse->id}.text")<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                            <details class="mt-1">
                                <summary class="text-xs text-gray-500 cursor-pointer">Original ({{ $verse->source_font ?? 'unknown font' }})</summary>
                                <pre class="text-xs text-gray-600 whitespace-pre-wrap">{{ $verse->raw_text }}</pre>
                            </details>
                            <label class="flex items-center mt-2 text-sm">
                                <input type="checkbox" name="verses[{{ $verse->id }}][approved]" value="1" @checked(old("verses.{$verse->id}.approved", $verse->review_status === 'approved')) class="h-4 w-4 text-green-600">
                                <span class="ml-2">Approved</span>
                            </label>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow-md p-6 text-gray-500">This hymn has no verses.</div>
    @endforelse

    <div class="flex gap-4">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700"><i class="fas fa-save mr-2"></i> Save</button>
        <a href="{{ route('dashboard.hymns.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Back</a>
    </div>
</form>
@endsection
