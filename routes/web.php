<?php

use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;

Route::get('check', function () {
    return 'ok';
});

Route::middleware([ CheckUser::class ])->group(function () {
    //Route::view('', 'template')->name('app');
    Route::view('api/docs/{chapter?}', 'template');
});

Route::view('', 'dashboard');
Route::view('design_system', 'design_system');
Route::view('login', 'login');
Route::view('login/2fa', 'login_2fa');
Route::view('forgot_password', 'forgot_password');
Route::view('reset_password', 'reset_password');

Route::prefix('accounting')->group(function () {
    Route::view('', 'accounting.pilotage');
    Route::view('balance', 'accounting.balance');
    Route::view('bank_reconciliation', 'accounting.bank_reconciliation');
    Route::view('general_ledger', 'accounting.general_ledger');
    Route::view('glossary', 'accounting.glossary');
    Route::view('journal_entry', 'accounting.journal_entry');
    Route::view('journals', 'accounting.journals');
    Route::view('lettering', 'accounting.lettering');
});

Route::prefix('api_management')->group(function () {
    Route::view('', 'api.global_view');
    Route::view('keys', 'api.keys');
    Route::view('logs', 'api.logs');
    Route::view('settings', 'api.settings');
    Route::view('webhooks', 'api.webhooks');
});

Route::prefix('explorer')->group(function () {
    Route::view('', 'explorer.explorer');
});

Route::prefix('hris')->group(function () {
    Route::view('', 'hris.myspace');

    Route::prefix('onboarding')->group(function () {
        Route::view('', 'hris.onboarding.onboarding');
        Route::view('offboarding', 'hris.onboarding.offboarding');
        Route::view('templates', 'hris.onboarding.templates');
    });

    Route::prefix('pay')->group(function () {
        Route::view('', 'hris.pay.cockpit');
        Route::view('settings', 'hris.pay.settings');
        Route::view('variables', 'hris.pay.variables');
    });
});

Route::prefix('site_editor')->group(function () {
    Route::prefix('analytics')->group(function () {
        Route::view('', 'site_editor.analytics.dashboard');
        Route::view('acquisition', 'site_editor.analytics.acquisition');
        Route::view('content', 'site_editor.analytics.content');
        Route::view('heatmaps', 'site_editor.analytics.heatmaps');
        Route::view('recordings', 'site_editor.analytics.recordings');
    });

    Route::view('editor', 'site_editor.editor');
    Route::view('data', 'site_editor.data');
    Route::view('media_library', 'site_editor.media_library');
    Route::view('variables', 'site_editor.variables');
});

Route::prefix('user')->group(function () {
    Route::view('settings', 'user.settings');
});