<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\DownloadExcelTrait;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ExportDiscountsUseCase extends UseCase
{
    use DownloadExcelTrait, OrganizationIdentifierTrait;

    public const EXPORT_FILENAME = 'discounts_report.xlsx';

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
    public function action(): string
    {
        if (!$this->laboratory) {
            return ProfitabilityExodusSDK::reports()->discountsSummaryExport(
                year: $this->year,
                months: $this->months,
                organization_identifier: $this->getOrganizationIdentifier()
            );
        }

        return ProfitabilityExodusSDK::reports()->discountsExport(
            year: $this->year,
            months: $this->months,
            laboratory: $this->laboratory,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
