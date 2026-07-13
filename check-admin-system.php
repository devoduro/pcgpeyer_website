#!/usr/bin/env php
<?php

/**
 * PCG Monninger Admin System Health Check
 * 
 * This script checks if the admin system is properly configured
 */

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║   PCG Monninger - Admin System Health Check               ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

$checks = [];
$errors = [];

// Check 1: Laravel Installation
echo "🔍 Checking Laravel installation...\n";
if (file_exists(__DIR__ . '/artisan')) {
    $checks[] = "✓ Laravel artisan file found";
} else {
    $errors[] = "✗ Laravel artisan file not found";
}

// Check 2: Vendor directory
echo "🔍 Checking dependencies...\n";
if (is_dir(__DIR__ . '/vendor')) {
    $checks[] = "✓ Vendor directory exists";
} else {
    $errors[] = "✗ Vendor directory not found - run 'composer install'";
}

// Check 3: .env file
echo "🔍 Checking configuration...\n";
if (file_exists(__DIR__ . '/.env')) {
    $checks[] = "✓ .env file exists";
} else {
    $errors[] = "✗ .env file not found - copy .env.example to .env";
}

// Check 4: Storage permissions
echo "🔍 Checking storage permissions...\n";
if (is_writable(__DIR__ . '/storage')) {
    $checks[] = "✓ Storage directory is writable";
} else {
    $errors[] = "✗ Storage directory is not writable - run 'chmod -R 775 storage'";
}

// Check 5: Bootstrap cache permissions
if (is_writable(__DIR__ . '/bootstrap/cache')) {
    $checks[] = "✓ Bootstrap cache is writable";
} else {
    $errors[] = "✗ Bootstrap cache is not writable - run 'chmod -R 775 bootstrap/cache'";
}

// Check 6: Public storage link
echo "🔍 Checking storage link...\n";
if (is_link(__DIR__ . '/public/storage')) {
    $checks[] = "✓ Storage link exists";
} else {
    $errors[] = "✗ Storage link not found - run 'php artisan storage:link'";
}

// Check 7: Key files exist
echo "🔍 Checking required files...\n";
$requiredFiles = [
    'app/Http/Controllers/Auth/AuthController.php',
    'app/Http/Middleware/DashboardAuth.php',
    'app/Http/Middleware/AdminOnly.php',
    'app/Http/Middleware/EditorOrAdmin.php',
    'app/Models/User.php',
    'routes/dashboard.php',
    'resources/views/dashboard/auth/login.blade.php',
    'resources/views/dashboard/layouts/app.blade.php',
];

foreach ($requiredFiles as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        $checks[] = "✓ $file exists";
    } else {
        $errors[] = "✗ $file is missing";
    }
}

// Check 8: Database migrations
echo "🔍 Checking database migrations...\n";
$migrationFiles = [
    'database/migrations/2024_01_01_000000_create_users_table.php',
];

foreach ($migrationFiles as $file) {
    if (file_exists(__DIR__ . '/' . $file)) {
        $checks[] = "✓ Users migration exists";
    } else {
        $errors[] = "✗ Users migration is missing";
    }
}

// Display results
echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "RESULTS\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "\n";

if (empty($errors)) {
    echo "✅ All checks passed!\n\n";
    foreach ($checks as $check) {
        echo "  $check\n";
    }
} else {
    echo "⚠️  Some issues were found:\n\n";
    foreach ($errors as $error) {
        echo "  $error\n";
    }
    echo "\n";
    echo "Passed checks:\n";
    foreach ($checks as $check) {
        echo "  $check\n";
    }
}

echo "\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "NEXT STEPS\n";
echo "═══════════════════════════════════════════════════════════\n";
echo "\n";

if (empty($errors)) {
    echo "Your admin system is ready! To access it:\n\n";
    echo "1. Start your web server (XAMPP, php artisan serve, etc.)\n";
    echo "2. Navigate to: http://localhost/pcgmonninger/dashboard/login\n";
    echo "3. Login with:\n";
    echo "   Email: admin@example.com\n";
    echo "   Password: (check database or create new user)\n\n";
    echo "To create a new admin user:\n";
    echo "   php artisan admin:create\n\n";
    echo "To seed default users:\n";
    echo "   php artisan db:seed --class=UserSeeder\n";
} else {
    echo "Please fix the issues above, then run this script again.\n";
}

echo "\n";
echo "For more information, see ADMIN_GUIDE.md\n";
echo "\n";
