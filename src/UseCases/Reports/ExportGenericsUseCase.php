<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\DownloadExcelTrait;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ExportGenericsUseCase extends UseCase
{
    use DownloadExcelTrait, OrganizationIdentifierTrait;

    public const EXPORT_FILENAME = 'generics_report.xlsx';

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
    public function action(): string
    {
        if (!$this->laboratory) {
            return ProfitabilityExodusSDK::reports()->genericsSummaryExport(
                year: $this->year,
                months: $this->months,
                filter_only_club: $this->filter_only_club,
                organization_identifier: $this->getOrganizationIdentifier()
            );
        }

        return ProfitabilityExodusSDK::reports()->genericsExport(
            year: $this->year,
            months: $this->months,
            laboratory: $this->laboratory,
            filter_only_club: $this->filter_only_club,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
