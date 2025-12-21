<?php

namespace App\Domains\I18n\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $label
 */
class I18nTimezone extends Model
{
    public $timestamps = false;

    protected $table = 'i18n_timezone';
}
