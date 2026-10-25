<?php

namespace App\Providers;

use App\Support\FirebaseTokenVerifier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(FirebaseTokenVerifier::class, fn () => new FirebaseTokenVerifier(config('firebase.project_id')));
    }

    public function boot()
    {
        //
    }
}
