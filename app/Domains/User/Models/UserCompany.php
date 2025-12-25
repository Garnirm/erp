<?php

namespace App\Domains\User\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $company_id
 * @property null|string $function
 * @property bool $active
 */
class UserCompany extends Model
{
    public $timestamps = false;

    protected $table = 'user_company';
}