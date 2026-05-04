<?php

namespace ProfitabilityExodus\SDK\Enums\Report;

use ProfitabilityExodus\SDK\Enums\AllowedTrait;

enum Type: string
{
    use AllowedTrait;

    case DISCOUNTS = 'DISCOUNTS';
    case FREE_SALES = 'FREE_SALES';
    case GENERICS = 'GENERICS';
    case MARGINS = 'MARGINS';

    public static function fromRoute(string $value): self
    {
        return match ($value) {
            'discounts' => self::DISCOUNTS,
            'free-sales' => self::FREE_SALES,
            'generics' => self::GENERICS,
            'margins' => self::MARGINS,
            default => throw new \InvalidArgumentException("Invalid report type: $value")
        };
    }

    public static function toExodus(self $report_type): string
    {
        return match ($report_type) {
            self::DISCOUNTS => 'discounts',
            self::FREE_SALES => 'otc',
            self::GENERICS => 'generics',
            self::MARGINS => 'margins'
        };
    }
}
