<?php

namespace App\Http\Middleware;

use App\Models\AppUser;
use App\Support\DevotionService;
use Closure;
use Illuminate\Http\Request;

/**
 * Server-side devotion-first gate. Put it on content routes (hymns, radio, sermons...) so the
 * lock cannot be bypassed by calling the API directly.
 */
class RequireDevotionDone
{
    public function __construct(private DevotionService $devotions)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user instanceof AppUser && $this->devotions->isLocked($user)) {
            return response()->json([
                'message' => "Complete today's devotional to continue.",
                'code' => 'devotion_required',
            ], 423);
        }

        return $next($request);
    }
}
