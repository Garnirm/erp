<?php

namespace Tests\Feature\User;

use App\Domains\User\Models\User;
use App\Services\Tests\ShortcutAddAccount;
use App\Services\Tests\ShortcutAddCompany;
use App\Services\Tests\ShortcutAddUser;
use Tests\TestCase;

class SettingsProfileTest extends TestCase
{
    public function test_update(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        $request = $this->actingAs($user)->post('/user/settings', [ 'firstname' => 'Update', 'lastname' => 'Settings' ]);
        $request->assertStatus(302);
        $request->assertLocation('/user/settings');

        /** @var User $user_updated */
        $user_updated = User::find($user->id);

        $this->assertEquals('Update', $user_updated->firstname);
        $this->assertEquals('Settings', $user_updated->lastname);
        $this->assertEquals('Update Settings', $user_updated->fullname_first);
        $this->assertEquals('Settings Update', $user_updated->fullname_last);
    }

    public function test_update_with_missing_firstname(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        $request = $this->actingAs($user)->post('/user/settings', [ 'lastname' => 'Settings' ]);
        $request->assertStatus(422);
    }

    public function test_update_with_missing_larstname(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        $request = $this->actingAs($user)->post('/user/settings', [ 'firstname' => 'Update' ]);
        $request->assertStatus(422);
    }
}
