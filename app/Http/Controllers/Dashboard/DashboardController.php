<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\Event;
use App\Models\Leadership;
use App\Models\MediaGallery;
use App\Models\Ministry;
use App\Models\PrayerRequest;
use App\Models\Sermon;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show dashboard home with statistics
     */
    public function index()
    {
        $stats = [
            'posts' => BlogPost::count(),
            'sermons' => Sermon::count(),
            'events' => Event::count(),
            'ministries' => Ministry::count(),
            'leadership' => Leadership::count(),
            'gallery_items' => MediaGallery::count(),
            'videos' => Video::count(),
            'prayer_requests' => PrayerRequest::where('is_answered', false)->count(),
            'contact_messages' => ContactSubmission::where('status', 'new')->count(),
            'active_users' => \App\Models\User::where('is_active', true)->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }

    /**
     * Show dashboard profile
     */
    public function profile()
    {
        $user = Auth::user();
        return view('dashboard.profile', compact('user'));
    }

    /**
     * Update user profile
     */
    public function updateProfile(\Illuminate\Http\Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);
        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Change password
     */
    public function changePassword(\Illuminate\Http\Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->password = $validated['password'];
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }
}
