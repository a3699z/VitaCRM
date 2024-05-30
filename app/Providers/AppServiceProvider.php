<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FirebaseAuthService;

use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Contract\Database;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // add firebaseservice
        // $this->app->singleton('firebase', function ($app) {
        //     return (new FirebaseAuthService(
        //         $app->make(FirebaseAuth::class),
        //         $app->make(Database::class)
        //     ));
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
