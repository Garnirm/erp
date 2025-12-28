<?php

use App\Domains\User\Controllers\DashboardController;
use App\Domains\User\Controllers\Settings\AppearanceController;
use App\Domains\User\Controllers\Settings\AppearanceSaveController;
use App\Domains\User\Controllers\Settings\NotificationsController;
use App\Domains\User\Controllers\Settings\ProfileController;
use App\Domains\User\Controllers\Settings\ProfileSaveController;
use App\Domains\User\Controllers\Settings\SecurityController;
use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web', CheckUser::class ])->group(function () {
    Route::get('', DashboardController::class);

    Route::prefix('user')->group(function () {
        Route::get('settings', ProfileController::class);
        Route::post('settings', ProfileSaveController::class);

        Route::get('settings/appearance', AppearanceController::class);
        Route::post('settings/appearance', AppearanceSaveController::class);

        Route::get('settings/notifications', NotificationsController::class);

        Route::get('settings/security', SecurityController::class);
    });
});
