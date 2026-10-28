<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MinistryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GroupLeadershipController;
use App\Http\Controllers\LegalController;
// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Mobile app legal pages (Google Play: privacy policy, terms, account deletion without the app)
Route::get('/privacy-policy', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/terms', [LegalController::class, 'terms'])->name('legal.terms');
Route::get('/account/delete', [LegalController::class, 'deleteAccountForm'])->name('legal.delete-account');
Route::post('/account/delete', [LegalController::class, 'deleteAccount'])
    ->middleware('throttle:5,1')->name('legal.delete-account.submit');

// About Us
Route::prefix('about')->name('about.')->group(function () {
    Route::get('/history', [AboutController::class, 'history'])->name('history');
    Route::get('/staff', [AboutController::class, 'staff'])->name('staff');
    Route::get('/leadership', [AboutController::class, 'leadership'])->name('leadership');
    Route::get('/ministers', [AboutController::class, 'ministers'])->name('ministers');
});

// Group Leadership
Route::prefix('group-leadership')->name('group-leadership.')->group(function () {
    Route::get('/', [GroupLeadershipController::class, 'index'])->name('index');
    Route::get('/{groupLeadership}', [GroupLeadershipController::class, 'show'])->name('show');
});

// Ministries
Route::prefix('ministries')->name('ministries.')->group(function () {
    Route::get('/inter-generational', [MinistryController::class, 'interGenerational'])->name('inter-generational');
    Route::get('/generational', [MinistryController::class, 'generational'])->name('generational');
    Route::get('/{slug}', [MinistryController::class, 'show'])->name('show');
});

// Media
Route::prefix('media')->name('media.')->group(function () {
    Route::get('/photos', [MediaController::class, 'photos'])->name('photos');
    Route::get('/videos', [MediaController::class, 'videos'])->name('videos');
});
// Gallery routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');

// Video routes
// Older video links: the video pages live under Media.
Route::get('/videos', fn () => redirect()->route('media.videos', [], 301))->name('videos');
Route::get('/videos/{id}', fn () => redirect()->route('media.videos', [], 301))->name('videos.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// News Update
Route::get('/news-update', [BlogController::class, 'index'])->name('news-update');
Route::get('/news-update/{slug}', [BlogController::class, 'show'])->name('news-update.show');

// Dashboard Routes
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    require base_path('routes/dashboard.php');
});
