<?php

return [
    // Timezone that defines "today" for the daily reset.
    'timezone' => env('DEVOTION_TIMEZONE', 'Africa/Accra'),

    // off: no lock for anyone | optional: each user may turn it on | required: lock applies to everyone
    'policy' => env('DEVOTION_POLICY', 'optional'),

    // Completion rules. Opening a devotional alone never counts as completing it.
    'min_read_seconds' => (int) env('DEVOTION_MIN_READ_SECONDS', 30),
    'require_reflection' => (bool) env('DEVOTION_REQUIRE_REFLECTION', false),

    // Modules the app should lock until today's devotional is completed.
    'locked_modules' => ['radio', 'hymns', 'sermons', 'videos', 'bible', 'events'],

    // Morning push window (church timezone). The first scheduler run at or after notify_from sends it.
    'notify_from' => env('DEVOTION_NOTIFY_FROM', '05:30'),
    'notify_until' => env('DEVOTION_NOTIFY_UNTIL', '11:00'),
];
