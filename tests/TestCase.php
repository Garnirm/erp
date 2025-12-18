<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        if (Auth::check()) {
            Auth::logout();
        }

        DB::table('account')->where('name', 'Client test')->delete();
    }

    public function tearDown(): void
    {
        if (Auth::check()) {
            Auth::logout();
        }

        DB::table('account')->where('name', 'Client test')->delete();

        DB::disconnect();
    }
}
