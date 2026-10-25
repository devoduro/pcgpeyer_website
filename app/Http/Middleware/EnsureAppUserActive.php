<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAppUserActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user && !$user->isActive()) {
            $user->tokens()->delete();
            return response()->json(['message' => 'This account is not active.'], 403);
        }
        return $next($request);
    }
}
