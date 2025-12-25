<?php

use App\Domains\User\Controllers\DashboardController;
use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;

Route::middleware([ 'web', CheckUser::class ])->group(function () {
    Route::get('', DashboardController::class);
});
