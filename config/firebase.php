<?php

return [
    // Firebase project used by the mobile app (android/app/google-services.json).
    'project_id' => env('FIREBASE_PROJECT_ID', 'bantama-presby'),

    // Google's public certificates for Firebase ID tokens.
    'certs_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com',
];
