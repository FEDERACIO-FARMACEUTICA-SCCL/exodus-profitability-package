<?php

namespace ProfitabilityExodus\UseCases\OtcDetail;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class GetUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected string $otc_type,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::otcDetail()->get(
            organization_identifier: $this->getOrganizationIdentifier(),
            otc_type: $this->otc_type
        );
    }
}
