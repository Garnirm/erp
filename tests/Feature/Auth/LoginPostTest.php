<?php

namespace Tests\Feature\Auth;

use App\Services\Tests\ShortcutAddAccount;
use App\Services\Tests\ShortcutAddCompany;
use App\Services\Tests\ShortcutAddUser;
use Tests\TestCase;

class LoginPostTest extends TestCase
{
    public function test_login(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);

        ShortcutAddUser::execute($account->id, $company->id);

        $request = $this->post('/login', [ 'email' => 'test@test.com', 'password' => 'test' ]);
        $request->assertStatus(302);
        $request->assertLocation(env('APP_URL'));
    }

    public function test_login_with_wrong_credentials(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);

        ShortcutAddUser::execute($account->id, $company->id);

        $request = $this->post('/login', [ 'email' => 'test@test.com', 'password' => 'testt' ]);
        $request->assertStatus(302);
        $request->assertLocation(env('APP_URL').'/login?status=failed_connection');
    }
}
