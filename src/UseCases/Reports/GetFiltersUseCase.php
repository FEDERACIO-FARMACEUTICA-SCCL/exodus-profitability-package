<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Enums\Report\Type;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class GetFiltersUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected Type $report_type,
        protected int $page = BaseExodus::DEFAULT_PAGE,
        protected int $per_page = BaseExodus::DEFAULT_PER_PAGE,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::reports()->filters(
            report_type: $this->report_type,
            page: $this->page,
            per_page: $this->per_page,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
