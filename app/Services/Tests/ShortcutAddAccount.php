<?php

namespace App\Services\Tests;

use App\Domains\Account\Models\Account;
use Carbon\Carbon;

class ShortcutAddAccount
{
    public static function execute(?string $name = null, ?string $slug = null): Account
    {
        $account = new Account();
        $account->name = (empty($name)) ? 'Client test' : $name;
        $account->slug = (empty($slug)) ? 'test' : $slug;
        $account->next_renewal = Carbon::parse('2099-12-30');
        $account->save();

        return $account;
    }
}
