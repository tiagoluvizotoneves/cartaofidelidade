<?php

namespace App\Providers;

use App\Auth\WordPressUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Auth::provider('wordpress', function ($app, array $config) {
            return new WordPressUserProvider();
        });
    }
}
