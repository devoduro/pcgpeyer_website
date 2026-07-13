<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect(route('dashboard.login'))->with('error', 'Please log in first.');
        }

        if (!Auth::user()->isActive()) {
            Auth::logout();
            return redirect(route('dashboard.login'))->with('error', 'Your account is inactive.');
        }

        return $next($request);
    }
}
