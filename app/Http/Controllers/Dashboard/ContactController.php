<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display list of contact submissions
     */
    public function index()
    {
        $submissions = ContactSubmission::latest('created_at')->paginate(15);
        return view('dashboard.contact.index', compact('submissions'));
    }

    /**
     * Show contact submission details
     */
    public function show(ContactSubmission $submission)
    {
        $submission->update(['status' => 'read']);
        return view('dashboard.contact.show', compact('submission'));
    }

    /**
     * Mark as replied
     */
    public function markReplied(Request $request, ContactSubmission $submission)
    {
        $validated = $request->validate([
            'admin_notes' => ['required', 'string'],
        ]);

        $submission->update([
            'status' => 'replied',
            'admin_notes' => $validated['admin_notes'],
            'replied_at' => now(),
        ]);

        return back()->with('success', 'Reply added successfully.');
    }

    /**
     * Mark as resolved
     */
    public function markResolved(ContactSubmission $submission)
    {
        $submission->update(['status' => 'resolved']);
        return back()->with('success', 'Submission marked as resolved.');
    }

    /**
     * Delete contact submission
     */
    public function destroy(ContactSubmission $submission)
    {
        $submission->delete();
        return redirect(route('dashboard.contact.index'))->with('success', 'Submission deleted.');
    }
}
