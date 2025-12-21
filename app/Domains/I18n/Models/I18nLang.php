<?php

namespace App\Domains\I18n\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property bool $enabled
 */
class I18nLang extends Model
{
    public $timestamps = false;

    protected $table = 'i18n_lang';
}
