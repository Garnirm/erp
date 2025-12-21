<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class I18nCountrySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('i18n_country')->insert(['id' => 1, 'code_iso2' => 'dr', 'code_iso3' => 'dra', 'translation_key' => 'country.drarekstanie', 'enabled' => true]);
        DB::table('i18n_country')->insert(['id' => 2, 'code_iso2' => 'fr', 'code_iso3' => 'fra', 'translation_key' => 'country.france', 'enabled' => true]);
    }
}
