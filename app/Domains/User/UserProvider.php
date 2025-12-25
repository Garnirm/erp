<?php
 
namespace App\Domains\User;

use Illuminate\Support\ServiceProvider;

class UserProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    public function register()
    {
    }
}