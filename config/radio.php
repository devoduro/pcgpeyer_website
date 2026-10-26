<?php

// Church radio station for the mobile app. Change the stream in .env without touching the app.
return [
    'title' => env('RADIO_TITLE', 'Peyer Radio'),
    'tagline' => env('RADIO_TAGLINE', 'Live from PCG Peyer Memorial Congregation'),
    'stream_url' => env('RADIO_STREAM_URL', 'https://stream.zeno.fm/qtr2onjcfs5vv'),
    'cover_url' => env('RADIO_COVER_URL'),
];
