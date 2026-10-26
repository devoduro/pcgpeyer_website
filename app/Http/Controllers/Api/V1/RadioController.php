<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RadioController extends Controller
{
    /** GET /radio: the live station the app plays (configured in config/radio.php / .env). */
    public function show(): JsonResponse
    {
        $stream = config('radio.stream_url');
        if (!$stream) {
            return response()->json(['message' => 'The church radio is not available at the moment.'], 404);
        }

        return response()->json([
            'station' => [
                'id' => 1,
                'title' => config('radio.title'),
                'tagline' => config('radio.tagline'),
                'stream_url' => $stream,
                'cover_url' => config('radio.cover_url'),
            ],
        ]);
    }
}
