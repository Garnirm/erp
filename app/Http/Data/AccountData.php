<?php

namespace App\Http\Data;

use App\Domains\Account\Models\Account;
use Illuminate\Http\Request;
use Spatie\LaravelData\Attributes\Computed;

trait AccountData
{
    #[Computed]
    public Account $account;

    public static function fromRequest(Request $request): static
    {
        /** @var array<non-empty-string> $explode_host */
        $explode_host = explode('.', $request->getHost());

        $domain = $explode_host[0] ?? 'error';

        $instance = static::from($request->all());

        /** @var null|Account $account */
        $account = Account::query()->where('slug', $domain)->select('id')->first();

        if ($account instanceof Account) {
            $instance->account = $account;
        }

        return $instance;
    }
}