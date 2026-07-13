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
        
        return view('group-leadership.index', compact('ministers'));
    }

    /**
     * Show the specified ministry leader
     */
    public function show(Ministry $ministry)
    {
        if (!$ministry->active) {
            abort(404);
        }
        return view('group-leadership.show', compact('ministry'));
    }
}
