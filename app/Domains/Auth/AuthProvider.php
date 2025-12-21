<?php
 
namespace App\Domains\Auth;

use Illuminate\Support\ServiceProvider;

class AuthProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    public function register()
    {
    }
}