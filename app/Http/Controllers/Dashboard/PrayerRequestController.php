<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PrayerRequest;
use Illuminate\Http\Request;

class PrayerRequestController extends Controller
{
    /**
     * Display list of prayer requests
     */
    public function index()
    {
        $requests = PrayerRequest::latest('created_at')->paginate(15);
        return view('dashboard.prayer-requests.index', compact('requests'));
    }

    /**
     * Show prayer request details
     */
    public function show(PrayerRequest $prayerRequest)
    {
        return view('dashboard.prayer-requests.show', compact('prayerRequest'));
    }

    /**
     * Mark prayer request as answered
     */
    public function markAnswered(PrayerRequest $prayerRequest)
    {
        $prayerRequest->update(['is_answered' => true]);
        return back()->with('success', 'Prayer request marked as answered.');
    }

    /**
     * Add admin notes
     */
    public function addNotes(Request $request, PrayerRequest $prayerRequest)
    {
        $validated = $request->validate([
            'admin_notes' => ['required', 'string'],
        ]);

        $prayerRequest->update($validated);
        return back()->with('success', 'Notes added successfully.');
    }

    /**
     * Delete prayer request
     */
    public function destroy(PrayerRequest $prayerRequest)
    {
        $prayerRequest->delete();
        return redirect(route('dashboard.prayer-requests.index'))->with('success', 'Prayer request deleted.');
    }
}
