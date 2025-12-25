<?php

namespace App\Domains\Account\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $account_id
 * @property int $i18n_country_id
 * @property string $name
 * @property null|string $city
 * @property null|string $address
 * @property null|string $address_complement
 * @property null|string $postal_code
 * @property null|string $siret
 * @property null|string $ape_code
 */
class Company extends Model
{
    public $timestamps = false;

    protected $table = 'company';

    /**
     * @param Builder<Company> $query
     * @return Builder<Company>
     */
    #[Scope]
    public function account(Builder $query, int $account_id): Builder
    {
        return $query->where('account_id', $account_id);
    }
}
