<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use Illuminate\Http\Request;

class GroupLeadershipController extends Controller
{
    /**
     * Display a listing of minister leaders from ministries
     */
    public function index()
    {
        // Fetch active ministries that have leaders
        $ministers = Ministry::active()
            ->whereNotNull('leader')
            ->orderBy('name', 'asc')
            ->get();
        
        // Shown instead when no group has a leader recorded yet.
        $groups = $ministers->isEmpty() ? Ministry::active()->orderBy('name')->get() : collect();

        return view('group-leadership.index', compact('ministers', 'groups'));
    }

    /**
     * A group's own page is its ministry page, which already shows the leader and meeting details.
     */
    public function show(string $groupLeadership)
    {
        return redirect()->route('ministries.show', $groupLeadership, 301);
    }
}
