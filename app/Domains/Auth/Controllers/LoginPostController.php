<?php

namespace App\Domains\Auth\Controllers;

use App\Domains\Auth\Data\LoginPostData;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LoginPostController extends Controller
{
    public function __invoke(LoginPostData $data): RedirectResponse
    {
        try {
            if (Auth::attempt($data->toArray())) {
                return redirect('/');
            }

            return redirect('/login?status=failed_connection');
        } catch (\Throwable $e) {
            Log::error($e);

            /*if (Auth::check() && !empty(Auth::user()->session_id)) {
                Cache::forget('auth_'.Auth::user()->session_id.'_last_activity');
            }*/

            Auth::logout();

            return redirect('/login?status=error_during_login');
        }
    }
}