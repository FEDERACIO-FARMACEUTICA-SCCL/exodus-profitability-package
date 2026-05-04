<?php

namespace ProfitabilityExodus\SDK\Enums\Report\FreeSale;

use ProfitabilityExodus\SDK\Enums\AllowedTrait;

enum ClassificationType: string
{
    use AllowedTrait;

    case ALL = 'ALL';
    case PARAPHARMACY = 'PARAPHARMACY';
    case PROMOTIONAL = 'PROMOTIONAL';

    public static function toExodus(self $classification_type): ?string
    {
        return $classification_type === self::ALL
            ? null
            : $classification_type->value;
    }
}
