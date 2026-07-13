@extends('dashboard.layouts.app')

@section('title', 'Create Ministry')
@section('page-title', 'Add New Ministry')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('dashboard.ministries.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Ministry Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('name') border-red-500 @enderror">
            @error('name')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category Type</label>
                <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="">Select Category Type</option>
                    <option value="inter-generational" {{ old('category') == 'inter-generational' ? 'selected' : '' }}>Inter-Generational</option>
                    <option value="generational" {{ old('category') == 'generational' ? 'selected' : '' }}>Generational</option>
                </select>
                @error('category')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label for="ministry_category" class="block text-sm font-semibold text-gray-700 mb-2">Ministry Category</label>
                <select id="ministry_category" name="ministry_category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="">Select Ministry Category</option>
                    <option value="Worship" {{ old('ministry_category') == 'Worship' ? 'selected' : '' }}>Worship</option>
                    <option value="Singers" {{ old('ministry_category') == 'Singers' ? 'selected' : '' }}>Singers</option>
                    <option value="Outreach" {{ old('ministry_category') == 'Outreach' ? 'selected' : '' }}>Outreach</option>
                    <option value="Prayer Group" {{ old('ministry_category') == 'Prayer Group' ? 'selected' : '' }}>Prayer Group</option>
                    <option value="Service" {{ old('ministry_category') == 'Service' ? 'selected' : '' }}>Service</option>
                    <option value="Children" {{ old('ministry_category') == 'Children' ? 'selected' : '' }}>Children</option>
                    <option value="Youth & Young Adults" {{ old('ministry_category') == 'Youth & Young Adults' ? 'selected' : '' }}>Youth & Young Adults</option>
                    <option value="Men" {{ old('ministry_category') == 'Men' ? 'selected' : '' }}>Men</option>
                    <option value="Women" {{ old('ministry_category') == 'Women' ? 'selected' : '' }}>Women</option>
                    <option value="Media" {{ old('ministry_category') == 'Media' ? 'selected' : '' }}>Media</option>
                    <option value="Fellowship" {{ old('ministry_category') == 'Fellowship' ? 'selected' : '' }}>Fellowship</option>
                    <option value="Care & Support" {{ old('ministry_category') == 'Care & Support' ? 'selected' : '' }}>Care & Support</option>
                </select>
                @error('ministry_category')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="age_range" class="block text-sm font-semibold text-gray-700 mb-2">Age Range (for Generational Ministries)</label>
            <input type="text" id="age_range" name="age_range" value="{{ old('age_range') }}" placeholder="e.g., 0-12 years, 13-19 years, All adult women" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            @error('age_range')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Full Content (Rich Text Editor)</label>
            <textarea id="content" name="content" rows="15" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ old('content') }}</textarea>
            <p class="text-sm text-gray-500 mt-2">Use the editor above to format your content with headings, lists, bold text, links, and more.</p>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="leader" class="block text-sm font-semibold text-gray-700 mb-2">Ministry Leader</label>
                <input type="text" id="leader" name="leader" value="{{ old('leader') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>

            <div>
                <label for="leader_phone" class="block text-sm font-semibold text-gray-700 mb-2">Leader Phone</label>
                <input type="text" id="leader_phone" name="leader_phone" value="{{ old('leader_phone') }}" placeholder="+233 24 123 4567" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('leader_phone')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="leader_picture" class="block text-sm font-semibold text-gray-700 mb-2">Leader Picture</label>
            <input type="file" id="leader_picture" name="leader_picture" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            <p class="text-xs text-gray-500 mt-1">Upload a photo of the ministry leader (Max 2MB, JPG/PNG)</p>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="contact_email" class="block text-sm font-semibold text-gray-700 mb-2">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>

            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}" placeholder="e.g., Church Auditorium" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('location')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label for="meeting_schedule" class="block text-sm font-semibold text-gray-700 mb-2">Meeting Schedule</label>
                <input type="text" id="meeting_schedule" name="meeting_schedule" value="{{ old('meeting_schedule') }}" placeholder="e.g., Every Sunday 3:00 PM" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Ministry Image</label>
                <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>
        </div>

        <div class="flex gap-4 mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 text-red-600">
                <span class="ml-2 text-sm text-gray-700">Featured Ministry</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="h-4 w-4 text-red-600">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                <i class="fas fa-save mr-2"></i> Save Ministry
            </button>
            <a href="{{ route('dashboard.ministries.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#content',
            height: 500,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic underline strikethrough | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | ' +
                'forecolor backcolor | removeformat | code | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 16px; line-height: 1.6; color: #374151; }',
            branding: false,
            promotion: false,
            statusbar: true,
            resize: true,
            block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4',
            setup: function(editor) {
                editor.on('init', function() {
                    console.log('TinyMCE Editor initialized successfully');
                });
            }
        });
    });
</script>
@endpush
