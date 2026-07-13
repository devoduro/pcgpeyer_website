<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GroupLeadership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupLeadershipController extends Controller
{
    /**
     * Display a listing of group leadership
     */
    public function index(Request $request)
    {
        $query = GroupLeadership::query();

        // Search by name or description
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $status = $request->get('status');
            if ($status === 'active') {
                $query->where('active', true);
            } elseif ($status === 'inactive') {
                $query->where('active', false);
            }
        }

        $groups = $query->ordered()->paginate(15)->appends($request->query());
        
        return view('dashboard.group-leadership.index', compact('groups'));
    }

    /**
     * Show the form for creating a new group
     */
    public function create()
    {
        return view('dashboard.group-leadership.create');
    }

    /**
     * Store a newly created group in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:group_leaderships'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('group-leadership', 'public');
            $validated['image'] = $path;
        }

        $validated['active'] = $request->has('active');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        GroupLeadership::create($validated);

        return redirect()->route('dashboard.group-leadership.index')
            ->with('success', 'Group leadership created successfully!');
    }

    /**
     * Show the form for editing a group
     */
    public function edit(GroupLeadership $groupLeadership)
    {
        return view('dashboard.group-leadership.edit', compact('groupLeadership'));
    }

    /**
     * Update the specified group in storage
     */
    public function update(Request $request, GroupLeadership $groupLeadership)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:group_leaderships,name,' . $groupLeadership->id],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($groupLeadership->image) {
                Storage::disk('public')->delete($groupLeadership->image);
            }
            $path = $request->file('image')->store('group-leadership', 'public');
            $validated['image'] = $path;
        }

        $validated['active'] = $request->has('active');
        $validated['display_order'] = $validated['display_order'] ?? $groupLeadership->display_order;

        $groupLeadership->update($validated);

        return redirect()->route('dashboard.group-leadership.index')
            ->with('success', 'Group leadership updated successfully!');
    }

    /**
     * Delete the specified group
     */
    public function destroy(GroupLeadership $groupLeadership)
    {
        if ($groupLeadership->image) {
            Storage::disk('public')->delete($groupLeadership->image);
        }

        $groupLeadership->delete();

        return redirect()->route('dashboard.group-leadership.index')
            ->with('success', 'Group leadership deleted successfully!');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(GroupLeadership $groupLeadership)
    {
        $groupLeadership->update(['active' => !$groupLeadership->active]);

        return back()->with('success', 'Group leadership status updated!');
    }
}
