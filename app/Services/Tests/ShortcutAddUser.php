<?php

namespace App\Services\Tests;

use App\Domains\I18n\Models\I18nTimezone;
use App\Domains\User\Models\User;
use App\Domains\User\Models\UserCompany;
use Illuminate\Support\Facades\Hash;

class ShortcutAddUser
{
    public static function execute(int $account_id, int $company_id): User
    {
        $user = new User();
        $user->account_id = $account_id;
        $user->email = 'test@test.com';
        $user->password = Hash::make('test', ['memory' => 1024, 'time' => 2, 'threads' => 2]);
        $user->firstname = 'Test';
        $user->lastname = 'Test';
        $user->fullname_first = 'Test Test';
        $user->fullname_last = 'Test Test';
        $user->avatar = 'upl/default_picture.jpg';
        $user->i18n_country_id = 1;
        $user->i18n_lang_id = 1;
        $user->i18n_timezone_id = I18nTimezone::query()->where('label', 'Europe/Paris')->first()->id; // @phpstan-ignore-line
        $user->date_format = 'YYYY-MM-DD';
        $user->save();

        $user_company = new UserCompany();
        $user_company->user_id = $user->id;
        $user_company->company_id = $company_id;
        $user_company->active = true;
        $user_company->save();

        return $user;
    }
}
