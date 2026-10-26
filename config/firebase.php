<?php

return [
    // Firebase project used by the mobile app (android/app/google-services.json, package com.pcgpeyer.mobileapp).
    'project_id' => env('FIREBASE_PROJECT_ID', 'pcg-peyer-app-4a8d4'),

    // Google's public certificates for Firebase ID tokens.
    'certs_url' => 'https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com',

    // Service-account key for sending push notifications (Firebase console > Project settings >
    // Service accounts > Generate new private key). Kept out of git.
    'credentials' => env('FIREBASE_CREDENTIALS', storage_path('app/firebase/service-account.json')),

    // Every app install subscribes to this topic, so one message reaches everyone (guests included).
    'devotion_topic' => env('FIREBASE_DEVOTION_TOPIC', 'devotions'),
];
