<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class GetGenericsUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected int $year,
        protected array $months,
        protected ?string $laboratory = null,
        protected bool $filter_only_club = false,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        if (!$this->laboratory) {
            return ProfitabilityExodusSDK::reports()->genericsSummary(
                year: $this->year,
                months: $this->months,
                filter_only_club: $this->filter_only_club,
                organization_identifier: $this->getOrganizationIdentifier()
            );
        }

        return ProfitabilityExodusSDK::reports()->generics(
            year: $this->year,
            months: $this->months,
            laboratory: $this->laboratory,
            filter_only_club: $this->filter_only_club,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
