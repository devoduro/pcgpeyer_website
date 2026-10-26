<?php

namespace App\Providers;

use App\Support\FcmPushNotifier;
use App\Support\FirebaseTokenVerifier;
use App\Support\PushNotifier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FirebaseTokenVerifier::class, fn () => new FirebaseTokenVerifier(config('firebase.project_id')));
        $this->app->singleton(PushNotifier::class, fn () => new FcmPushNotifier(config('firebase.project_id'), config('firebase.credentials')));
    }

    public function boot()
    {
        //
    }
}
