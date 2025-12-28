<?php

namespace App\Domains\User\Data;

use Spatie\LaravelData\Data;

class SettingsProfileSaveData extends Data
{
    public function __construct(
        public string $firstname,
        public string $lastname,
    )
    {
    }
}