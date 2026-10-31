<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GroupLeader;
use App\Models\Ministry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * The executives of each fellowship, guild and singing group, shown on /group-leadership and on
 * the group's own ministry page.
 */
class GroupLeaderController extends Controller
{
    public function index()
    {
        $ministries = Ministry::orderBy('name')->get(['id', 'name', 'slug']);

        $groups = Ministry::whereHas('leaders')->with('leaders')->orderBy('name')->get();

        return view('dashboard.group-leaders.index', compact('ministries', 'groups'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request, true);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('group-leaders', 'public');
        }

        $leader = GroupLeader::create($validated);

        return redirect(route('dashboard.group-leaders.index') . '#group-' . $leader->ministry_id)
            ->with('success', "{$leader->name} added to {$leader->ministry->name}.");
    }

    public function update(Request $request, GroupLeader $groupLeader)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('photo')) {
            $old = $groupLeader->photo;
            $validated['photo'] = $request->file('photo')->store('group-leaders', 'public');
            if ($old) {
                Storage::disk('public')->delete($old);
            }
        }

        $groupLeader->update($validated);

        return redirect(route('dashboard.group-leaders.index') . '#group-' . $groupLeader->ministry_id)
            ->with('success', "{$groupLeader->name} updated.");
    }

    public function destroy(GroupLeader $groupLeader)
    {
        if ($groupLeader->photo) {
            Storage::disk('public')->delete($groupLeader->photo);
        }
        $groupLeader->delete();

        return redirect(route('dashboard.group-leaders.index') . '#group-' . $groupLeader->ministry_id)
            ->with('success', "{$groupLeader->name} removed.");
    }

    private function validated(Request $request, bool $creating = false): array
    {
        $validated = $request->validate([
            'ministry_id' => [$creating ? 'required' : 'prohibited', 'exists:ministries,id'],
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer', 'min:0', 'max:999'],
            'photo' => ['nullable', 'image', 'max:5120'],
        ]);

        $validated['display_order'] = $validated['display_order'] ?? 0;
        $validated['active'] = $request->boolean('active');

        return $validated;
    }
}
