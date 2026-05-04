<?php

namespace ProfitabilityExodus\UseCases\DedicationAndPayments;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class GetUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected string $from_month,
        protected string $to_month,
        protected ?string $organization_identifier
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::dedicationsAndPayments()->get(
            from_month: $this->from_month,
            to_month: $this->to_month,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
