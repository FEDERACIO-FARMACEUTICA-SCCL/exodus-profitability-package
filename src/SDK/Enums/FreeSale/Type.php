<?php

namespace ProfitabilityExodus\SDK\Enums\FreeSale;

enum Type: string
{
    case PARAPHARMACY = 'PARAPHARMACY';
    case PROMOTIONAL = 'PROMOTIONAL';

    public static function fromRoute(string $value): self
    {
        return match ($value) {
            'parapharmacy' => self::PARAPHARMACY,
            'promotional' => self::PROMOTIONAL,
            default => throw new \InvalidArgumentException("Invalid free sales type: $value")
        };
    }
}
