<?php

namespace App\Domains\User\Data;

use App\Cast\ModelFromIdCast;
use App\Domains\I18n\Models\I18nCountry;
use App\Domains\I18n\Models\I18nLang;
use App\Domains\I18n\Models\I18nTimezone;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class SettingsAppearanceSaveData extends Data
{
    public function __construct(
        #[WithCast(ModelFromIdCast::class)]
        public I18nCountry $country,

        #[WithCast(ModelFromIdCast::class)]
        public I18nLang $lang,

        #[WithCast(ModelFromIdCast::class)]
        public I18nTimezone $timezone,

        public string $date_format,
    )
    {
    }
}