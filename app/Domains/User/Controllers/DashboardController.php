<?php

namespace App\Domains\User\Controllers;

use App\Domains\User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = Auth::user();

        return Inertia::render('App/Dashboard', [
            'firstname' => $user->firstname,
        ]);
    }
}