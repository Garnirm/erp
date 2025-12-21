<?php

namespace App\Domains\Account\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property null|int $created_by_user_id
 * @property string $name
 * @property string $slug
 * @property Carbon $next_renewal
 */
class Account extends Model
{
    protected $table = 'account';

    protected $casts = [
        'next_renewal' => 'date:Y-m-d',
    ];
}
