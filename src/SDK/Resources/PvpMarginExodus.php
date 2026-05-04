<?php

namespace ProfitabilityExodus\SDK\Resources;

use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Validators\DatesValidator;

class PvpMarginExodus extends BaseExodus
{
    public const ENDPOINT_GET = '/Margins/margin_pvp';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function get(
        string $from_month,
        string $to_month,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_GET,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'organization_identifier' => $organization_identifier,
            ]
        );
    }
}
