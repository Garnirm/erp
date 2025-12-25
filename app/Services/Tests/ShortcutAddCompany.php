<?php

namespace App\Services\Tests;

use App\Domains\Account\Models\Company;

class ShortcutAddCompany
{
    public static function execute(int $account_id, string $name = 'Company test'): Company
    {
        $company = new Company();
        $company->account_id = $account_id;
        $company->name = $name;
        $company->i18n_country_id = 1;
        $company->save();

        return $company;
    }
}
