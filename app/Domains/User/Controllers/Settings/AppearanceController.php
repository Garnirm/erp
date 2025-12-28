<?php

namespace App\Domains\User\Controllers\Settings;

use App\Domains\I18n\Models\I18nCountry;
use App\Domains\I18n\Models\I18nLang;
use App\Domains\I18n\Models\I18nTimezone;
use App\Domains\User\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AppearanceController
{
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = Auth::user();

        return Inertia::render('App/User/SettingsAppearance', [
            'date_formats' => (new Collection([ 'JJ/MM/AAAA' => 'd/m/Y', 'AAAA-MM-JJ' => 'Y-m-d', 'MM/JJ/AAAA' => 'm-d-Y' ]))
                ->map(function (string $carbon_format, string $format): array {
                    return [
                        'value' => $carbon_format,
                        'label' => $format.' ('.Carbon::now()->format($carbon_format).')',
                    ];
                })
                ->values()
                ->toArray(),

            'timezones' => I18nTimezone::query()->select('id as value', 'label')->toBase()->get()->toArray(),
            'countries' => I18nCountry::query()->select('id as value', 'translation_key as label')->toBase()->get()->toArray(),
            'langs' => I18nLang::query()->select('id as value', 'name as label')->toBase()->get()->toArray(),

            'user_timezone' => $user->i18n_timezone_id,
            'user_country' => $user->i18n_country_id,
            'user_lang' => $user->i18n_lang_id,
            'user_date_format' => $user->date_format,
        ]);
    }
}