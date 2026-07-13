<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display list of users
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $users = $query->latest('created_at')->paginate(15);
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store new user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,editor,viewer'],
            'permissions' => ['nullable', 'array'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => $validated['password'],
            'role' => $validated['role'],
            'permissions' => $validated['permissions'] ?? [],
            'is_active' => true,
        ];

        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        $user = User::create($data);

        ActivityLog::log('created', "Created user: {$user->name}", User::class, $user->id);

        return redirect(route('dashboard.users.index'))->with('success', 'User created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'in:admin,editor,viewer'],
            'permissions' => ['nullable', 'array'],
            'profile_picture' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'permissions' => $validated['permissions'] ?? [],
        ];

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $data['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        $user->update($data);

        ActivityLog::log('updated', "Updated user: {$user->name}", User::class, $user->id);

        return redirect(route('dashboard.users.index'))->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return back()->with('error', 'Cannot delete your own account.');
        }

        $userName = $user->name;

        // Delete profile picture
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        ActivityLog::log('deleted', "Deleted user: {$userName}", User::class, $user->id);

        return redirect(route('dashboard.users.index'))->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle user active status
     */
    public function toggleActive(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return back()->with('error', 'Cannot deactivate your own account.');
        }

        $newStatus = !$user->is_active;
        $user->update(['is_active' => $newStatus]);

        $status = $newStatus ? 'activated' : 'deactivated';
        ActivityLog::log('status_changed', "User {$status}: {$user->name}", User::class, $user->id);

        return back()->with('success', 'User status updated.');
    }

    /**
     * Show activity logs
     */
    public function logs(Request $request)
    {
        $query = ActivityLog::with('user')->latest('created_at');

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->paginate(50);
        $users = User::orderBy('name')->get();
        $actions = ActivityLog::distinct()->pluck('action');

        return view('dashboard.users.logs', compact('logs', 'users', 'actions'));
    }

    /**
     * Show user profile
     */
    public function show(User $user)
    {
        $recentActivity = $user->activityLogs()->latest()->limit(20)->get();
        return view('dashboard.users.show', compact('user', 'recentActivity'));
    }
}
