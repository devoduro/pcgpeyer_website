<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use Illuminate\Http\Request;

class GroupLeadershipController extends Controller
{
    /**
     * Each group's executives, then groups that only have a single leader recorded on the ministry
     */
    public function index()
    {
        $activeLeaders = fn ($q) => $q->active();

        // Groups with their executives entered under Dashboard > Group Leaders
        $teams = Ministry::active()
            ->whereHas('leaders', $activeLeaders)
            ->with(['leaders' => $activeLeaders])
            ->orderBy('name', 'asc')
            ->get();

        // Groups with just a leader name on the ministry record
        $ministers = Ministry::active()
            ->whereNotNull('leader')
            ->whereNotIn('id', $teams->pluck('id'))
            ->orderBy('name', 'asc')
            ->get();

        // Shown instead when no group has a leader recorded yet.
        $groups = $teams->isEmpty() && $ministers->isEmpty() ? Ministry::active()->orderBy('name')->get() : collect();

        return view('group-leadership.index', compact('teams', 'ministers', 'groups'));
    }

    /**
     * A group's own page is its ministry page, which already shows the leader and meeting details.
     */
    public function show(string $groupLeadership)
    {
        return redirect()->route('ministries.show', $groupLeadership, 301);
    }
}
