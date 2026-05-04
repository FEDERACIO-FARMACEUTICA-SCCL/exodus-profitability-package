<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\Enums\Report\FreeSale\ClassificationType;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class GetFreeSalesUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected int $year,
        protected array $months,
        protected ClassificationType $classification_type = ClassificationType::ALL,
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
            return ProfitabilityExodusSDK::reports()->freeSalesSummary(
                year: $this->year,
                months: $this->months,
                classification_type: $this->classification_type,
                organization_identifier: $this->getOrganizationIdentifier()
            );
        }

        return ProfitabilityExodusSDK::reports()->freeSales(
            year: $this->year,
            months: $this->months,
            classification_type: $this->classification_type,
            laboratory: $this->laboratory,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
