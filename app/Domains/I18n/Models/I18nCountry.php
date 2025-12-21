<?php

namespace App\Domains\I18n\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code_iso2
 * @property string $code_iso3
 * @property string $translation_key
 * @property bool $enabled
 */
class I18nCountry extends Model
{
    public $timestamps = false;

    protected $table = 'i18n_country';
}
