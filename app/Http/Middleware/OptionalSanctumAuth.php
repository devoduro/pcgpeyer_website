<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Public routes that guests may use: if the app sends a token, $request->user() resolves the
 * signed-in user (so devotion-first, streaks etc. apply); without one the request is a guest.
 */
class OptionalSanctumAuth
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken()) {
            auth()->shouldUse('sanctum');
        }

        return $next($request);
    }
}
