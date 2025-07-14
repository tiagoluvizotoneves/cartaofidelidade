<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Auth\WpUserProvider;

class WpUserAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Auth::provider('wpusers', function ($app, array $config) {
            return new WpUserProvider($app['hash'], $config['model']);
        });
    }
}
