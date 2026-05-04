<?php

namespace ProfitabilityExodus\SDK\Resources;

use ProfitabilityExodus\SDK\Core\BaseExodus;

class OrganizationExodus extends BaseExodus
{
    public const ENDPOINT_INFORMATION = '/Main/organization_info';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function information(
        ?string $organization_identifier = null
    ): array {
        return $this->request(
            endpoint: self::ENDPOINT_INFORMATION,
            data: [
                'organization_identifier' => $organization_identifier,
            ]
        );
    }
}
