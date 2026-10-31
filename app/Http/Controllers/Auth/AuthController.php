<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Five tries per minute for each email and address pair
        $throttleKey = Str::lower($credentials['email']) . '|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->onlyInput('email')
                ->withErrors(['email' => "Too many sign-in attempts. Please try again in {$seconds} seconds."]);
        }

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            if (!$user->isActive()) {
                Auth::logout();
                return back()->onlyInput('email')->withErrors(['email' => 'Your account is inactive.']);
            }

            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard.index'))->with('success', 'Welcome back, ' . $user->name . '!');
        }

        RateLimiter::hit($throttleKey, 60);
        return back()->onlyInput('email')->withErrors(['email' => 'That email and password do not match an account.']);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'))->with('success', 'You have been signed out.');
    }

    /**
     * Show registration form (admin only)
     */
    public function showRegisterForm()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect(route('dashboard.index'))->with('error', 'Unauthorized');
        }
        return view('dashboard.auth.register');
    }

    /**
     * Handle user registration (admin only)
     */
    public function register(Request $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect(route('dashboard.index'))->with('error', 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,editor,viewer'],
        ]);

        // Password will be auto-hashed by the User model's setPasswordAttribute mutator
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => $validated['role'],
            'is_active' => true,
        ]);

        return redirect(route('dashboard.users.index'))->with('success', 'User created successfully.');
    }
}
