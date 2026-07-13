@extends('dashboard.layouts.app')

@section('title', 'Manage Leadership Years')
@section('page-title', 'Manage Leadership Years')

@section('content')
<div class="max-w-6xl">
    <!-- Add New Year -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-6">Add New Year Range</h3>
        <form action="{{ route('dashboard.leadership.store-year') }}" method="POST" class="grid grid-cols-4 gap-4">
            @csrf

            <div>
                <label for="year" class="block text-sm font-semibold text-gray-700 mb-2">Start Year *</label>
                <input type="number" id="year" name="year" min="1900" max="2100" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('year') border-red-500 @enderror">
                @error('year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="year_end" class="block text-sm font-semibold text-gray-700 mb-2">End Year</label>
                <input type="number" id="year_end" name="year_end" min="1900" max="2100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('year_end') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Leave blank for single year</p>
                @error('year_end') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <input type="text" id="description" name="description" placeholder="e.g., Church Year 2024-2025" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('description') border-red-500 @enderror">
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-cyan-600 text-white px-4 py-2 rounded-lg hover:bg-cyan-700 transition flex items-center justify-center gap-2">
                    <i class="fas fa-plus"></i> Add Range
                </button>
            </div>
        </form>
    </div>

    <!-- Years List -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Leadership Years</h3>
        </div>

        @if($years->isEmpty())
            <div class="p-8 text-center text-gray-500">
                <p>No years created yet. Add one using the form above.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Year Range</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Description</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Members</th>
                            <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-8 py-4 text-right text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($years as $year)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-8 py-4">
                                    <span class="font-semibold text-gray-800">{{ $year->yearRange }}</span>
                                </td>
                                <td class="px-8 py-4 text-gray-600">
                                    {{ $year->description ?? '—' }}
                                </td>
                                <td class="px-8 py-4">
                                    <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                        {{ $year->leaders()->count() }} member{{ $year->leaders()->count() != 1 ? 's' : '' }}
                                    </span>
                                </td>
                                <td class="px-8 py-4">
                                    @if($year->active)
                                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-block bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex gap-3 justify-end">
                                        @if($year->active)
                                            <form action="{{ route('dashboard.leadership.toggle-year', $year) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium transition" title="Deactivate">
                                                    <i class="fas fa-ban"></i> Deactivate
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('dashboard.leadership.toggle-year', $year) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-800 text-sm font-medium transition" title="Activate">
                                                    <i class="fas fa-check"></i> Activate
                                                </button>
                                            </form>
                                        @endif

                                        <button onclick="editYear({{ $year->id }}, {{ $year->year }}, {{ $year->year_end ?? 'null' }}, '{{ addslashes($year->description ?? '') }}')" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>

                                        @if($year->leaders()->count() == 0)
                                            <form action="{{ route('dashboard.leadership.delete-year', $year) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this year?')" class="text-red-600 hover:text-red-800 text-sm font-medium transition" title="Delete">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="mt-8">
        <a href="{{ route('dashboard.leadership.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition inline-flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back to Leadership
        </a>
    </div>
</div>

<!-- Edit Year Modal -->
<div id="editYearModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xs">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <h3 class="text-base font-bold text-gray-800">Edit Year Range</h3>
            <button type="button" onclick="closeEditYearModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <form id="editYearForm" method="POST" class="p-4 space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label for="editYear" class="block text-xs font-semibold text-gray-700 mb-1">Start Year</label>
                <input type="number" id="editYear" name="year" min="1900" max="2100" required class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-cyan-500 focus:outline-none">
            </div>

            <div>
                <label for="editYearEnd" class="block text-xs font-semibold text-gray-700 mb-1">End Year</label>
                <input type="number" id="editYearEnd" name="year_end" min="1900" max="2100" class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-cyan-500 focus:outline-none">
                <p class="text-xs text-gray-500 mt-1">Leave blank for single year</p>
            </div>

            <div>
                <label for="editDescription" class="block text-xs font-semibold text-gray-700 mb-1">Description</label>
                <input type="text" id="editDescription" name="description" class="w-full px-2 py-1 text-sm border border-gray-300 rounded focus:ring-1 focus:ring-cyan-500 focus:outline-none">
            </div>

            <div class="flex gap-2 pt-2">
                <button type="submit" class="flex-1 bg-cyan-600 text-white text-sm py-1 rounded hover:bg-cyan-700 transition">
                    Update
                </button>
                <button type="button" onclick="closeEditYearModal()" class="flex-1 bg-gray-300 text-gray-700 text-sm py-1 rounded hover:bg-gray-400 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function editYear(id, year, yearEnd, description) {
    document.getElementById('editYear').value = year;
    document.getElementById('editYearEnd').value = yearEnd || '';
    document.getElementById('editDescription').value = description;
    document.getElementById('editYearForm').action = `/dashboard/leadership/manage-years/${id}`;
    document.getElementById('editYearModal').classList.remove('hidden');
}

function closeEditYearModal() {
    document.getElementById('editYearModal').classList.add('hidden');
}

// Close modal on backdrop click
document.getElementById('editYearModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditYearModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !document.getElementById('editYearModal').classList.contains('hidden')) {
        closeEditYearModal();
    }
});
</script>
@endsection
