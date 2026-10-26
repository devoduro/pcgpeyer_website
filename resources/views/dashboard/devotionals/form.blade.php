@extends('dashboard.layouts.app')

@php $editing = $devotional->exists; @endphp
@section('title', $editing ? 'Edit Devotional' : 'New Devotional')
@section('page-title', $editing ? 'Edit Devotional' : 'Create New Devotional')

@section('content')
@php $input = 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent'; @endphp
<div class="max-w-4xl">
    <form action="{{ $editing ? route('dashboard.devotionals.update', $devotional) : route('dashboard.devotionals.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
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

        <div class="mb-6">
            <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">Image (optional)</label>
            @if($devotional->thumbnail)
                <div class="flex items-center gap-4 mb-2">
                    <img src="{{ asset('storage/' . $devotional->thumbnail) }}" alt="" class="h-20 w-32 object-cover rounded-lg border">
                    <label class="text-sm text-gray-600"><input type="checkbox" name="remove_thumbnail" value="1" class="mr-1">Remove image</label>
                </div>
            @endif
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="text-sm">
            @error('thumbnail')<span class="text-red-500 text-sm block">{{ $message }}</span>@enderror
            <p class="text-xs text-gray-500 mt-1">Shown at the top of the devotion and in the notification. Up to 2 MB.</p>
        </div>

        {{-- Morning notification --}}
        <fieldset class="mb-6 rounded-lg border border-gray-200 p-5">
            <legend class="px-2 text-sm font-semibold text-gray-700"><i class="fas fa-bell mr-1"></i> Morning notification</legend>
            <label class="flex items-center mb-4">
                <input type="checkbox" id="notify" name="notify" value="1" {{ old('notify', $devotional->notify ?? true) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
                <span class="ml-2 text-sm text-gray-700">Send to everyone with the app on the morning of this day ({{ config('devotion.notify_from') }}, Ghana time)</span>
            </label>
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="notification_title" class="block text-sm font-semibold text-gray-700 mb-2">Notification title (optional)</label>
                    <input type="text" id="notification_title" name="notification_title" maxlength="100" value="{{ old('notification_title', $devotional->notification_title) }}" placeholder="Today's devotion" class="{{ $input }}">
                    @error('notification_title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    <label for="notification_body" class="block text-sm font-semibold text-gray-700 mb-2 mt-4">Notification message (optional)</label>
                    <textarea id="notification_body" name="notification_body" maxlength="240" rows="2" placeholder="Title · Scripture" class="{{ $input }}">{{ old('notification_body', $devotional->notification_body) }}</textarea>
                    @error('notification_body')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                    <p class="text-xs text-gray-500 mt-1">Leave empty to use the devotional's title and scripture.</p>
                </div>
                {{-- Preview of how the phone shows it --}}
                <div>
                    <div class="text-sm font-semibold text-gray-700 mb-2">Preview</div>
                    <div class="rounded-2xl bg-gray-900 p-4">
                        <div class="rounded-xl bg-white/95 p-3 flex gap-3 shadow">
                            <div class="h-9 w-9 shrink-0 rounded-lg bg-primary-600 text-white flex items-center justify-center"><i class="fas fa-church text-sm"></i></div>
                            <div class="min-w-0">
                                <div class="text-[11px] text-gray-500">PCG Peyer · now</div>
                                <div id="preview-title" class="text-sm font-semibold text-gray-900 truncate"></div>
                                <div id="preview-body" class="text-sm text-gray-700 line-clamp-2"></div>
                            </div>
                        </div>
                    </div>
                    @if($devotional->notified_at)
                        <p class="text-xs text-blue-700 mt-2"><i class="fas fa-check-circle"></i> Sent {{ $devotional->notified_at->timezone(config('devotion.timezone'))->format('M j, Y g:ia') }}</p>
                    @endif
                </div>
            </div>
        </fieldset>

        <label class="flex items-center mb-6">
            <input type="checkbox" name="published" value="1" {{ old('published', $devotional->published) ? 'checked' : '' }} class="h-4 w-4 text-green-600">
            <span class="ml-2 text-sm text-gray-700">Published</span>
        </label>

        <script>
            (function () {
                const val = id => (document.getElementById(id)?.value || '').trim();
                function update() {
                    document.getElementById('preview-title').textContent = val('notification_title') || "Today's devotion";
                    const fallback = [val('title') || 'Title', val('scripture_reference') || 'Scripture'].join(' · ');
                    document.getElementById('preview-body').textContent = val('notification_body') || fallback;
                }
                ['notification_title', 'notification_body', 'title', 'scripture_reference'].forEach(id =>
                    document.getElementById(id)?.addEventListener('input', update));
                update();
            })();
        </script>

        <div class="flex gap-4">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-save mr-2"></i> {{ $editing ? 'Save Changes' : 'Create Devotional' }}
            </button>
            <a href="{{ route('dashboard.devotionals.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">Cancel</a>
        </div>
    </form>
</div>
@endsection
