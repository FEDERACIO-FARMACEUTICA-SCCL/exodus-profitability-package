<?php

namespace ProfitabilityExodus\UseCases\Organization;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class GetInformationUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::organization()->information(organization_identifier: $this->getOrganizationIdentifier());
    }
}
