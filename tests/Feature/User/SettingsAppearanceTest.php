<?php

namespace Tests\Feature\User;

use App\Domains\I18n\Models\I18nCountry;
use App\Domains\I18n\Models\I18nLang;
use App\Domains\I18n\Models\I18nTimezone;
use App\Domains\User\Models\User;
use App\Services\Tests\ShortcutAddAccount;
use App\Services\Tests\ShortcutAddCompany;
use App\Services\Tests\ShortcutAddUser;
use Tests\TestCase;

class SettingsAppearanceTest extends TestCase
{
    public function test_update(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        /** @var I18nCountry $france */
        $france = I18nCountry::query()->where('code_iso2', 'fr')->first();

        /** @var I18nLang $francais */
        $francais = I18nLang::query()->where('code', 'fr')->first();

        /** @var I18nTimezone $europe_paris */
        $europe_paris = I18nTimezone::query()->where('label', 'Europe/Paris')->first();

        $request = $this->actingAs($user)->post('/user/settings/appearance', [
            'country' => $france->id,
            'lang' => $francais->id,
            'timezone' => $europe_paris->id,
            'date_format' => 'Y-m-d',
        ]);

        $request->assertStatus(302);
        $request->assertLocation('/user/settings/appearance');

        /** @var User $user_updated */
        $user_updated = User::find($user->id);

        $this->assertEquals($france->id, $user_updated->i18n_country_id);
        $this->assertEquals($francais->id, $user_updated->i18n_lang_id);
        $this->assertEquals($europe_paris->id, $user_updated->i18n_timezone_id);
        $this->assertEquals('Y-m-d', $user_updated->date_format);
    }

    public function test_update_with_missing_country(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        /** @var I18nLang $francais */
        $francais = I18nLang::query()->where('code', 'fr')->first();

        /** @var I18nTimezone $europe_paris */
        $europe_paris = I18nTimezone::query()->where('label', 'Europe/Paris')->first();

        $request = $this->actingAs($user)->post('/user/settings/appearance', [
            'lang' => $francais->id,
            'timezone' => $europe_paris->id,
            'date_format' => 'Y-m-d',
        ]);

        $request->assertStatus(422);
    }

    public function test_update_with_missing_lang(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        /** @var I18nCountry $france */
        $france = I18nCountry::query()->where('code_iso2', 'fr')->first();

        /** @var I18nTimezone $europe_paris */
        $europe_paris = I18nTimezone::query()->where('label', 'Europe/Paris')->first();

        $request = $this->actingAs($user)->post('/user/settings/appearance', [
            'country' => $france->id,
            'timezone' => $europe_paris->id,
            'date_format' => 'Y-m-d',
        ]);

        $request->assertStatus(422);
    }

    public function test_update_with_missing_timezone(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        /** @var I18nCountry $france */
        $france = I18nCountry::query()->where('code_iso2', 'fr')->first();

        /** @var I18nLang $francais */
        $francais = I18nLang::query()->where('code', 'fr')->first();

        $request = $this->actingAs($user)->post('/user/settings/appearance', [
            'country' => $france->id,
            'lang' => $francais->id,
            'date_format' => 'Y-m-d',
        ]);

        $request->assertStatus(422);
    }

    public function test_update_with_missing_date_format(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        /** @var I18nCountry $france */
        $france = I18nCountry::query()->where('code_iso2', 'fr')->first();

        /** @var I18nLang $francais */
        $francais = I18nLang::query()->where('code', 'fr')->first();

        /** @var I18nTimezone $europe_paris */
        $europe_paris = I18nTimezone::query()->where('label', 'Europe/Paris')->first();

        $request = $this->actingAs($user)->post('/user/settings/appearance', [
            'country' => $france->id,
            'lang' => $francais->id,
            'timezone' => $europe_paris->id,
        ]);

        $request->assertStatus(422);
    }

    public function test_update_with_unexisted_country(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        /** @var I18nLang $francais */
        $francais = I18nLang::query()->where('code', 'fr')->first();

        /** @var I18nTimezone $europe_paris */
        $europe_paris = I18nTimezone::query()->where('label', 'Europe/Paris')->first();

        $request = $this->actingAs($user)->post('/user/settings/appearance', [
            'country' => 0,
            'lang' => $francais->id,
            'timezone' => $europe_paris->id,
            'date_format' => 'Y-m-d',
        ]);

        $request->assertStatus(404);
    }

    public function test_update_with_unexisted_lang(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        /** @var I18nCountry $france */
        $france = I18nCountry::query()->where('code_iso2', 'fr')->first();

        /** @var I18nTimezone $europe_paris */
        $europe_paris = I18nTimezone::query()->where('label', 'Europe/Paris')->first();

        $request = $this->actingAs($user)->post('/user/settings/appearance', [
            'country' => $france->id,
            'lang' => 0,
            'timezone' => $europe_paris->id,
            'date_format' => 'Y-m-d',
        ]);

        $request->assertStatus(404);
    }

    public function test_update_with_unexisted_timezone(): void
    {
        $account = ShortcutAddAccount::execute();
        $company = ShortcutAddCompany::execute($account->id);
        $user = ShortcutAddUser::execute($account->id, $company->id);

        /** @var I18nCountry $france */
        $france = I18nCountry::query()->where('code_iso2', 'fr')->first();

        /** @var I18nLang $francais */
        $francais = I18nLang::query()->where('code', 'fr')->first();

        $request = $this->actingAs($user)->post('/user/settings/appearance', [
            'country' => $france->id,
            'lang' => $francais->id,
            'timezone' => 0,
            'date_format' => 'Y-m-d',
        ]);

        $request->assertStatus(404);
    }
}
