<?php

namespace ProfitabilityExodus\SDK\Resources;

use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Enums\Report\FreeSale\ClassificationType;
use ProfitabilityExodus\SDK\Enums\Report\Type;
use ProfitabilityExodus\SDK\Validators\DatesValidator;
use ProfitabilityExodus\SDK\Validators\PaginationValidator;

class ReportsExodus extends BaseExodus
{
    public const ERROR_CODE_1 = 'SVC_EXODUS-REPE-0001';
    public const ERROR_CODE_2 = 'SVC_EXODUS-REPE-0002';
    public const ERROR_CODE_3 = 'SVC_EXODUS-REPE-0003';
    public const ERROR_CODE_4 = 'SVC_EXODUS-REPE-0004';
    public const ERROR_CODE_5 = 'SVC_EXODUS-REPE-0005';
    public const ERROR_CODE_6 = 'SVC_EXODUS-REPE-0006';
    public const ERROR_CODE_7 = 'SVC_EXODUS-REPE-0007';
    public const ERROR_CODE_8 = 'SVC_EXODUS-REPE-0008';

    public const ERROR_MESSAGE_1 = 'Failed to export discounts report.';
    public const ERROR_MESSAGE_2 = 'Failed to export discounts summary report.';
    public const ERROR_MESSAGE_3 = 'Failed to export freeSales report.';
    public const ERROR_MESSAGE_4 = 'Failed to export freeSales summary report.';
    public const ERROR_MESSAGE_5 = 'Failed to export generics report.';
    public const ERROR_MESSAGE_6 = 'Failed to export generics summary report.';
    public const ERROR_MESSAGE_7 = 'Failed to export margins report.';
    public const ERROR_MESSAGE_8 = 'Failed to export margins summary report.';

    public const ENDPOINT_DISCOUNTS = '/ProfitabilityReports/discounts';
    public const ENDPOINT_DISCOUNTS_EXPORT = self::ENDPOINT_DISCOUNTS . '/xlsx';
    public const ENDPOINT_DISCOUNTS_SUMMARY = '/ProfitabilityReports/discounts/summary';
    public const ENDPOINT_DISCOUNTS_SUMMARY_EXPORT = self::ENDPOINT_DISCOUNTS_SUMMARY . '/xlsx';
    public const ENDPOINT_FILTERS = '/ProfitabilityReports/filters';
    public const ENDPOINT_FREE_SALES = '/ProfitabilityReports/otc';
    public const ENDPOINT_FREE_SALES_EXPORT = self::ENDPOINT_FREE_SALES . '/xlsx';
    public const ENDPOINT_FREE_SALES_SUMMARY = '/ProfitabilityReports/otc/summary';
    public const ENDPOINT_FREE_SALES_SUMMARY_EXPORT = self::ENDPOINT_FREE_SALES_SUMMARY . '/xlsx';
    public const ENDPOINT_GENERICS = '/ProfitabilityReports/generics';
    public const ENDPOINT_GENERICS_EXPORT = self::ENDPOINT_GENERICS . '/xlsx';
    public const ENDPOINT_GENERICS_SUMMARY = '/ProfitabilityReports/generics/summary';
    public const ENDPOINT_GENERICS_SUMMARY_EXPORT = self::ENDPOINT_GENERICS_SUMMARY . '/xlsx';
    public const ENDPOINT_MARGINS = '/ProfitabilityReports/margins';
    public const ENDPOINT_MARGINS_EXPORT = self::ENDPOINT_MARGINS . '/xlsx';
    public const ENDPOINT_MARGINS_SUMMARY = '/ProfitabilityReports/margins/summary';
    public const ENDPOINT_MARGINS_SUMMARY_EXPORT = self::ENDPOINT_MARGINS_SUMMARY . '/xlsx';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function discounts(
        int $year,
        array $months,
        ?string $laboratory = null,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_DISCOUNTS,
            data: [
                'year' => $year,
                'months' => $months,
                'laboratory_identifier' => $laboratory,
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function discountsExport(
        int $year,
        array $months,
        ?string $laboratory = null,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_DISCOUNTS_EXPORT,
            data: [
                'year' => $year,
                'months' => $months,
                'laboratory_identifier' => $laboratory,
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function discountsSummary(
        int $year,
        array $months,
        ?string $organization_identifier = null,
    ): array {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_DISCOUNTS_SUMMARY,
            data: [
                'year' => $year,
                'months' => $months,
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function discountsSummaryExport(
        int $year,
        array $months,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_DISCOUNTS_SUMMARY_EXPORT,
            data: [
                'year' => $year,
                'months' => $months,
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function filters(
        Type $report_type,
        int $page,
        int $per_page,
        ?string $organization_identifier = null
    ): array {
        PaginationValidator::validate($page, $per_page);

        return $this->request(
            endpoint: self::ENDPOINT_FILTERS,
            data: [
                'report_type' => Type::toExodus($report_type),
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function freeSales(
        int $year,
        array $months,
        ClassificationType $classification_type = ClassificationType::ALL,
        ?string $laboratory = null,
        ?string $organization_identifier = null,
    ): array {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_FREE_SALES,
            data: [
                'otc_type' => ClassificationType::toExodus($classification_type),
                'year' => $year,
                'months' => $months,
                'laboratory_identifier' => $laboratory,
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function freeSalesExport(
        int $year,
        array $months,
        ClassificationType $classification_type = ClassificationType::ALL,
        ?string $laboratory = null,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_FREE_SALES_EXPORT,
            data: [
                'otc_type' => ClassificationType::toExodus($classification_type),
                'year' => $year,
                'months' => $months,
                'laboratory_identifier' => $laboratory,
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function freeSalesSummary(
        int $year,
        array $months,
        ClassificationType $classification_type = ClassificationType::ALL,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_FREE_SALES_SUMMARY,
            data: [
                'year' => $year,
                'months' => $months,
                'otc_type' => ClassificationType::toExodus($classification_type),
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function freeSalesSummaryExport(
        int $year,
        array $months,
        ClassificationType $classification_type = ClassificationType::ALL,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_FREE_SALES_SUMMARY_EXPORT,
            data: [
                'year' => $year,
                'months' => $months,
                'otc_type' => ClassificationType::toExodus($classification_type),
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function generics(
        int $year,
        array $months,
        ?string $laboratory = null,
        bool $filter_only_club = false,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_GENERICS,
            data: [
                'year' => $year,
                'months' => $months,
                'laboratory_identifier' => $laboratory,
                'type' => $filter_only_club ? 'CLUB' : null,
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function genericsExport(
        int $year,
        array $months,
        ?string $laboratory = null,
        bool $filter_only_club = false,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_GENERICS_EXPORT,
            data: [
                'year' => $year,
                'months' => $months,
                'laboratory_identifier' => $laboratory,
                'type' => $filter_only_club ? 'CLUB' : null,
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function genericsSummary(
        int $year,
        array $months,
        bool $filter_only_club = false,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_GENERICS_SUMMARY,
            data: [
                'year' => $year,
                'months' => $months,
                'type' => $filter_only_club ? 'CLUB' : null,
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function genericsSummaryExport(
        int $year,
        array $months,
        bool $filter_only_club = false,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::yearAndMonths($year, $months);

        return $this->request(
            endpoint: self::ENDPOINT_GENERICS_SUMMARY_EXPORT,
            data: [
                'year' => $year,
                'months' => $months,
                'type' => $filter_only_club ? 'CLUB' : null,
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function margins(
        string $from_month,
        string $to_month,
        ?string $laboratory = null,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_MARGINS,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'laboratory_identifier' => $laboratory,
                'organization_identifier' => $organization_identifier,
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function marginsExport(
        string $from_month,
        string $to_month,
        ?string $laboratory = null,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_MARGINS_EXPORT,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'laboratory_identifier' => $laboratory,
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function marginsSummary(
        string $from_month,
        string $to_month,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_MARGINS_SUMMARY,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function marginsSummaryExport(
        string $from_month,
        string $to_month,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_MARGINS_SUMMARY_EXPORT,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }
}
