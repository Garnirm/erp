<?php

namespace App\Domains\User\Controllers;

use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class SettingsProfileController
{
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = Auth::user();

        return Inertia::render('App/User/SettingsProfile', [
            'last_update' => $user->updated_at->toDateTimeString(),
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'email' => $user->email,
        ]);
    }
}