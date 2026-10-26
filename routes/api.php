<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DevotionalController;
use App\Http\Controllers\Api\V1\HymnController;
use App\Http\Controllers\Api\V1\LeadershipController;
use App\Http\Controllers\Api\V1\MembershipController;
use App\Http\Controllers\Api\V1\RadioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Mobile app API (v1) is served under /api/v1
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/ping', fn () => response()->json(['ok' => true]));

    // Public, strictly throttled
    Route::middleware('throttle:10,1')->group(function () {
        Route::post('/auth/register', [AuthController::class, 'register']);
        Route::post('/auth/login', [AuthController::class, 'login']);
        Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);
    });

    // Readable without an account (guests). With a token, the signed-in user is recognised, so
    // devotion-first and reading records apply to them.
    Route::middleware(['auth.optional', 'app.active'])->group(function () {
        // Live church radio station
        Route::get('/radio', [RadioController::class, 'show']);

        // Church leadership (same information as the public website pages)
        Route::get('/leadership', [LeadershipController::class, 'index']);
        Route::get('/leadership/past', [LeadershipController::class, 'past']);
        Route::get('/group-leadership', [LeadershipController::class, 'groups']);

        // Devotions: always reachable, even while the rest of the app is locked
        Route::get('/devotionals/status', [DevotionalController::class, 'status']);
        Route::get('/devotionals/today', [DevotionalController::class, 'today']);
        Route::get('/devotionals/{devotional}', [DevotionalController::class, 'showById'])->whereNumber('devotional');

        // Content locked behind devotion-first mode (only ever for signed-in users)
        Route::middleware('devotion.done')->group(function () {
            Route::get('/hymns', [HymnController::class, 'index']);
            Route::get('/hymns/sync', [HymnController::class, 'sync']);
            Route::get('/hymns/{number}', [HymnController::class, 'show'])->whereNumber('number');
        });
    });

    // Authenticated app users
    Route::middleware(['auth:sanctum', 'app.active'])->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/me', [AuthController::class, 'updateProfile']);
        Route::post('/me/password', [AuthController::class, 'changePassword']);
        Route::post('/me/delete', [AuthController::class, 'requestDeletion']);

        Route::middleware('throttle:5,1')->group(function () {
            Route::post('/auth/verify-email', [AuthController::class, 'verifyEmail']);
            Route::post('/auth/verify-email/firebase', [AuthController::class, 'verifyEmailWithFirebase']);
            Route::post('/auth/resend-verification', [AuthController::class, 'resendVerification']);
        });

        // Devotion actions that need an account
        Route::get('/devotionals/history', [DevotionalController::class, 'history']);
        Route::post('/devotionals/{devotional}/complete', [DevotionalController::class, 'complete']);
        Route::post('/me/devotion-first', [DevotionalController::class, 'setDevotionFirst']);

        Route::post('/membership/apply', [MembershipController::class, 'apply']);
        Route::get('/membership/status', [MembershipController::class, 'status']);
    });
});
