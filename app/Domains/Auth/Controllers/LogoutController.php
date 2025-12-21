<?php

namespace App\Domains\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LogoutController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        /*if (Auth::check() && !empty(Auth::user()->session_id)) {
            Cache::forget('auth_'.Auth::user()->session_id.'_last_activity');
        }*/

        Auth::logout();

        return redirect('/login');
    }
}