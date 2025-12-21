<?php

namespace App\Domains\Auth\Data;

use App\Domains\Account\Models\Account;
use App\Http\Data\AccountData;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

class LoginPostData extends Data
{
    use AccountData;

    public function __construct(
        #[Email]
        public string $email,

        public string $password,
    )
    {
        $this->account = new Account();
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'account_id' => $this->account->id,
        ];
    }
}