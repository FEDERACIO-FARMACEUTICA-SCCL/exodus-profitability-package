<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class GetDiscountsUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected int $year,
        protected array $months,
        protected ?string $laboratory = null,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        if (!$this->laboratory) {
            return ProfitabilityExodusSDK::reports()->discountsSummary(
                year: $this->year,
                months: $this->months,
                organization_identifier: $this->getOrganizationIdentifier()
            );
        }

        return ProfitabilityExodusSDK::reports()->discounts(
            year: $this->year,
            months: $this->months,
            laboratory: $this->laboratory,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
