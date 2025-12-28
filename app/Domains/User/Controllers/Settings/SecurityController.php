<?php

namespace App\Domains\User\Controllers\Settings;

use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class SecurityController
{
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = Auth::user();

        return Inertia::render('App/User/SettingsSecurity');
    }
}