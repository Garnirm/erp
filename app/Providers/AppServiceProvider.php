<?php

namespace App\Providers;

use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot(): void
    {
        if (config('app.env') === 'prod') {
            URL::forceScheme('https');
        }

        Auth::provider('auth', fn ($app) => new UserGuardProvider($app->make(User::class)));

        View::composer('layout', function ($view) {});
    }
}
