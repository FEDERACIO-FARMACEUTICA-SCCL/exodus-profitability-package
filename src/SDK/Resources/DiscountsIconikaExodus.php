<?php

namespace ProfitabilityExodus\SDK\Resources;

use Illuminate\Support\Str;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Enums\FreeSale\Type;
use ProfitabilityExodus\SDK\Validators\DatesValidator;
use ProfitabilityExodus\SDK\Validators\PaginationValidator;

class DiscountsIconikaExodus extends BaseExodus
{
    public const ENDPOINT_CATEGORIES = '/discounts/iconika/categories';
    public const ENDPOINT_LABORATORIES = '/discounts/iconika/laboratories';
    public const ENDPOINT_LABORATORIES_EXPORT = self::ENDPOINT_LABORATORIES . '/xlsx';
    public const ENDPOINT_PRODUCTS = '/Otc/list';
    public const ENDPOINT_PRODUCTS_EXPORT = self::ENDPOINT_PRODUCTS . '/xlsx';

    public const ERROR_CODE_1 = 'SVC_EXODUS-RDISICNKE-0001';

    public const ERROR_MESSAGE_1 = 'Failed to export Iconika laboratories discounts list from Exodus.';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function categories(
        string $from_month,
        string $to_month,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_CATEGORIES,
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
    public function exportLaboratories(
        Type $type,
        string $from_month,
        string $to_month,
        ?string $search_query = null,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_LABORATORIES_EXPORT,
            data: [
                'otc_type' => $type->value,
                'from_month' => $from_month,
                'to_month' => $to_month,
                'filter' => Str::upper($search_query),
                'organization_identifier' => $organization_identifier,
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function exportProducts(
        Type $type,
        string $from_month,
        string $to_month,
        ?string $search_query = null,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_PRODUCTS_EXPORT,
            data: [
                'otc_type' => $type->value,
                'from_month' => $from_month,
                'to_month' => $to_month,
                'filter' => Str::upper($search_query),
                'organization_identifier' => $organization_identifier
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function listLaboratories(
        Type $type,
        string $from_month,
        string $to_month,
        ?string $search_query = null,
        ?int $page = null,
        ?int $per_page = null,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);
        PaginationValidator::validate($page, $per_page);

        return $this->request(
            endpoint: self::ENDPOINT_LABORATORIES,
            data: [
                'otc_type' => $type->value,
                'from_month' => $from_month,
                'to_month' => $to_month,
                'filter' => Str::upper($search_query),
                'page' => $page,
                'per_page' => $per_page,
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function listProducts(
        Type $type,
        string $from_month,
        string $to_month,
        ?string $search_query = null,
        ?int $page = null,
        ?int $per_page = null,
        ?string $organization_identifier = null,
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);
        PaginationValidator::validate($page, $per_page);

        return $this->request(
            endpoint: self::ENDPOINT_PRODUCTS,
            data: [
                'otc_type' => $type->value,
                'from_month' => $from_month,
                'to_month' => $to_month,
                'filter' => Str::upper($search_query),
                'page' => $page,
                'per_page' => $per_page,
                'organization_identifier' => $organization_identifier
            ]
        );
    }
}
