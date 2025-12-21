<?php

use App\Domains\Auth\Controllers\LoginGetController;
use App\Domains\Auth\Controllers\LoginPostController;
use App\Domains\Auth\Controllers\LogoutController;
use App\Http\Middleware\CheckGuest;
use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web', CheckGuest::class ])->group(function () {
    Route::get('login', LoginGetController::class)->name('auth.login.get');
    Route::post('login', LoginPostController::class)->name('auth.login.post');
});

Route::middleware([ 'web', CheckUser::class ])->group(function () {
    Route::get('logout', LogoutController::class);
});
