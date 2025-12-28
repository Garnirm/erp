<?php

namespace App\Cast;

use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Types\NamedType;

class ModelFromIdCast implements Cast
{
    // @phpstan-ignore-next-line
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        if ($value === null) {
            return null;
        }

        /** @var NamedType $named_type */
        $named_type = $property->type->type;

        return $named_type->name::findOrFail($value);
    }
}