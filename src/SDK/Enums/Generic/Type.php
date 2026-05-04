<?php

namespace ProfitabilityExodus\SDK\Enums\Generic;

enum Type: string
{
    case ACOFARMA = 'ACOFARMA';
    case CONCENTRATION = 'CONCENTRATION';
    case GENERIFICATION = 'GENERIFICATION';

    public static function fromRoute(string $value): self
    {
        return match ($value) {
            'acofarma' => self::ACOFARMA,
            'concentration' => self::CONCENTRATION,
            'generification' => self::GENERIFICATION,
            default => throw new \InvalidArgumentException("Invalid generics type: $value")
        };
    }

    public static function toExodus(self $type): string
    {
        return match ($type) {
            self::ACOFARMA => 'acofar_quota',
            self::CONCENTRATION => 'concentration',
            self::GENERIFICATION => 'quota'
        };
    }
}
