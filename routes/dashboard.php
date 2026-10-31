<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\BlogPostController;
use App\Http\Controllers\Dashboard\SermonController;
use App\Http\Controllers\Dashboard\MinistryController;
use App\Http\Controllers\Dashboard\GalleryController;
use App\Http\Controllers\Dashboard\VideoController;
use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\AnnouncementController;
use App\Http\Controllers\Dashboard\DevotionalController;
use App\Http\Controllers\Dashboard\HymnController;
use App\Http\Controllers\Dashboard\PrayerRequestController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\LeadershipController;
use App\Http\Controllers\Dashboard\GroupLeadershipController;
use App\Http\Controllers\Dashboard\GroupLeaderController;

// Sign-in now lives at /login (routes/web.php); keep old bookmarks working
Route::get('/login', fn () => redirect()->route('login', [], 301));

Route::middleware('dashboard.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/password', [DashboardController::class, 'changePassword'])->name('password.change');

    // Blog Posts Management
    Route::middleware('editor.or.admin')->group(function () {
        Route::resource('blog', BlogPostController::class);
        Route::post('blog/{blog}/toggle-publish', [BlogPostController::class, 'togglePublish'])->name('blog.toggle-publish');

        // Sermons Management
        Route::resource('sermons', SermonController::class);
        Route::post('sermons/{sermon}/toggle-featured', [SermonController::class, 'toggleFeatured'])->name('sermons.toggle-featured');

        // Ministries Management
        Route::resource('ministries', MinistryController::class);
        Route::post('ministries/{ministry}/toggle-active', [MinistryController::class, 'toggleActive'])->name('ministries.toggle-active');

        // Gallery Management
        Route::resource('gallery', GalleryController::class)->names([
            'index' => 'galleries.index',
            'create' => 'galleries.create',
            'store' => 'galleries.store',
            'show' => 'galleries.show',
            'edit' => 'galleries.edit',
            'update' => 'galleries.update',
            'destroy' => 'galleries.destroy',
        ]);
        
        // Video Management
        Route::resource('videos', VideoController::class);
        Route::post('videos/{video}/toggle-featured', [VideoController::class, 'toggleFeatured'])->name('videos.toggle-featured');
        Route::post('videos/{video}/toggle-published', [VideoController::class, 'togglePublished'])->name('videos.toggle-published');

        // Events Management
        Route::resource('events', EventController::class);
        Route::post('events/{event}/toggle-featured', [EventController::class, 'toggleFeatured'])->name('events.toggle-featured');

        // Announcements Management
        Route::resource('announcements', AnnouncementController::class);
        Route::post('announcements/{announcement}/toggle-publish', [AnnouncementController::class, 'togglePublish'])->name('announcements.toggle-publish');

        // Devotionals Management
        Route::resource('devotionals', DevotionalController::class)->except('show');
        Route::post('devotionals/{devotional}/toggle-publish', [DevotionalController::class, 'togglePublish'])->name('devotionals.toggle-publish');
        Route::post('devotionals/{devotional}/notify', [DevotionalController::class, 'sendNotification'])->name('devotionals.notify');

        // Hymn review (imported drafts)
        Route::get('hymns', [HymnController::class, 'index'])->name('hymns.index');
        Route::get('hymns/{hymn}/edit', [HymnController::class, 'edit'])->name('hymns.edit');
        Route::get('hymns/{hymn}/source', [HymnController::class, 'source'])->name('hymns.source');
        Route::put('hymns/{hymn}', [HymnController::class, 'update'])->name('hymns.update');
        Route::post('hymns/{hymn}/toggle-publish', [HymnController::class, 'togglePublish'])->name('hymns.toggle-publish');
        Route::delete('hymns/{hymn}', [HymnController::class, 'destroy'])->name('hymns.destroy');
    });

    // Prayer Requests Management
    Route::middleware('editor.or.admin')->group(function () {
        Route::get('prayer-requests', [PrayerRequestController::class, 'index'])->name('prayer-requests.index');
        Route::get('prayer-requests/{prayerRequest}', [PrayerRequestController::class, 'show'])->name('prayer-requests.show');
        Route::post('prayer-requests/{prayerRequest}/mark-answered', [PrayerRequestController::class, 'markAnswered'])->name('prayer-requests.mark-answered');
        Route::post('prayer-requests/{prayerRequest}/notes', [PrayerRequestController::class, 'addNotes'])->name('prayer-requests.notes');
        Route::delete('prayer-requests/{prayerRequest}', [PrayerRequestController::class, 'destroy'])->name('prayer-requests.destroy');
    });

    // Contact Submissions Management
    Route::middleware('editor.or.admin')->group(function () {
        Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('contact/{submission}', [ContactController::class, 'show'])->name('contact.show');
        Route::post('contact/{submission}/reply', [ContactController::class, 'markReplied'])->name('contact.reply');
        Route::post('contact/{submission}/resolve', [ContactController::class, 'markResolved'])->name('contact.resolve');
        Route::delete('contact/{submission}', [ContactController::class, 'destroy'])->name('contact.destroy');
    });

    // Leadership Management
    Route::middleware('editor.or.admin')->group(function () {
        // Leadership Years Management (must come before resource routes)
        Route::get('leadership/manage-years', [LeadershipController::class, 'manageYears'])->name('leadership.manage-years');
        Route::post('leadership/manage-years', [LeadershipController::class, 'storeYear'])->name('leadership.store-year');
        Route::put('leadership/manage-years/{year}', [LeadershipController::class, 'updateYear'])->name('leadership.update-year');
        Route::post('leadership/manage-years/{year}/toggle', [LeadershipController::class, 'toggleYear'])->name('leadership.toggle-year');
        Route::delete('leadership/manage-years/{year}', [LeadershipController::class, 'deleteYear'])->name('leadership.delete-year');

        // Leadership Titles Management (must come before resource routes)
        Route::get('leadership/manage-titles', [LeadershipController::class, 'manageTitles'])->name('leadership.manage-titles');
        Route::post('leadership/manage-titles', [LeadershipController::class, 'storeTitle'])->name('leadership.store-title');
        Route::put('leadership/manage-titles/{title}', [LeadershipController::class, 'updateTitle'])->name('leadership.update-title');
        Route::post('leadership/manage-titles/{title}/toggle', [LeadershipController::class, 'toggleTitle'])->name('leadership.toggle-title');
        Route::delete('leadership/manage-titles/{title}', [LeadershipController::class, 'deleteTitle'])->name('leadership.delete-title');

        // Leadership Resource Routes
        Route::resource('leadership', LeadershipController::class);
        Route::patch('leadership/{leadership}/toggle-active', [LeadershipController::class, 'toggleActive'])->name('leadership.toggle-active');

        // Group Leadership Management
        Route::resource('group-leadership', GroupLeadershipController::class);
        Route::patch('group-leadership/{groupLeadership}/toggle-active', [GroupLeadershipController::class, 'toggleActive'])->name('group-leadership.toggle-active');

        // Executives of each fellowship and guild, shown on the public Group Leaders page
        Route::resource('group-leaders', GroupLeaderController::class)->only(['index', 'store', 'update', 'destroy']);
    });

    // User Management (Admin Only)
    Route::middleware('admin.only')->group(function () {
        Route::get('users/logs', [UserController::class, 'logs'])->name('users.logs');
        Route::resource('users', UserController::class);
        Route::post('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
        Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('register', [AuthController::class, 'register'])->name('register.post');
    });
});
