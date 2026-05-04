<?php

namespace ProfitabilityExodus\SDK\Resources;

use ProfitabilityExodus\SDK\Core\BaseExodus;

class OtcDetailExodus extends BaseExodus
{
    public const ENDPOINT_GET = '/Margins/otc_detail';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function get(
        ?string $organization_identifier = null,
        string $otc_type,
    ): array {
        return $this->request(
            endpoint: self::ENDPOINT_GET,
            data: [
                'organization_identifier' => $organization_identifier,
                'otc_type' => $otc_type,
            ]
        );
    }
}
