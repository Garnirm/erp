<?php

use App\Domains\User\Controllers\DashboardController;
use App\Domains\User\Controllers\SettingsProfileController;
use App\Domains\User\Controllers\SettingsProfileSaveController;
use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web', CheckUser::class ])->group(function () {
    Route::get('', DashboardController::class);

    Route::prefix('user')->group(function () {
        Route::get('settings', SettingsProfileController::class);
        Route::post('settings', SettingsProfileSaveController::class);
    });
});
