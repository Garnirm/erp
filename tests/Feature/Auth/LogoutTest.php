<?php

namespace Tests\Feature\Auth;

use App\Services\Tests\ShortcutAddAccount;
use App\Services\Tests\ShortcutAddCompany;
use App\Services\Tests\ShortcutAddUser;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function test_logout(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        $request = $this->actingAs($user)->get('/logout');
        $request->assertStatus(302);
        $request->assertLocation('/login');
    }
}
