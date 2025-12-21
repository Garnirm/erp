<?php

namespace App\Domains\Auth\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class LoginGetController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Guest/Login');
    }
}