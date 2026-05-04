<?php

namespace ProfitabilityExodus\SDK\Enums;

trait AllowedTrait
{
    public static function allowedValues(): array
    {
        return array_map(static fn (self $enum) => $enum->value, self::cases());
    }
}
