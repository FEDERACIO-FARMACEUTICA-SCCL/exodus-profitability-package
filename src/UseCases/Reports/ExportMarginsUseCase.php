<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\DownloadExcelTrait;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ExportMarginsUseCase extends UseCase
{
    use DownloadExcelTrait, OrganizationIdentifierTrait;

    public const EXPORT_FILENAME = 'margins_report.xlsx';

    public function __construct(
        protected string $from_month,
        protected string $to_month,
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
            return ProfitabilityExodusSDK::reports()->marginsSummaryExport(
                from_month: $this->from_month,
                to_month: $this->to_month,
                organization_identifier: $this->getOrganizationIdentifier()
            );
        }

        return ProfitabilityExodusSDK::reports()->marginsExport(
            from_month: $this->from_month,
            to_month: $this->to_month,
            laboratory: $this->laboratory,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
