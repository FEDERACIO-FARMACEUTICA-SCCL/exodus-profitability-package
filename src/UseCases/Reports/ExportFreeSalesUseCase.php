<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\Enums\Report\FreeSale\ClassificationType;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\DownloadExcelTrait;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ExportFreeSalesUseCase extends UseCase
{
    use DownloadExcelTrait, OrganizationIdentifierTrait;

    public const EXPORT_FILENAME = 'free_sales_report.xlsx';

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
    public function action(): string
    {
        if (!$this->laboratory) {
            return ProfitabilityExodusSDK::reports()->freeSalesSummaryExport(
                year: $this->year,
                months: $this->months,
                classification_type: $this->classification_type,
                organization_identifier: $this->getOrganizationIdentifier()
            );
        }

        return ProfitabilityExodusSDK::reports()->freeSalesExport(
            year: $this->year,
            months: $this->months,
            classification_type: $this->classification_type,
            laboratory: $this->laboratory,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
