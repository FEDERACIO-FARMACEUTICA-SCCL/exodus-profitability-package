<?php

namespace ProfitabilityExodus\UseCases\Discounts;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class DetailUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected string $from_month,
        protected string $to_month,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::discounts()->detail(
            from_month: $this->from_month,
            to_month: $this->to_month,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
