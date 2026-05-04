<?php

namespace ProfitabilityExodus\SDK\Resources;

use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Enums\FreeSale\Type;
use ProfitabilityExodus\SDK\Validators\DatesValidator;
use ProfitabilityExodus\SDK\Validators\PaginationValidator;

class DiscountsExodus extends BaseExodus
{
    public const ENDPOINT_DETAIL = '/Main/list_headers';
    public const ENDPOINT_GET = '/Discounts/company/summary';
    public const ENDPOINT_LIST = '/Otc/list';
    public const ENDPOINT_LIST_EXPORT = self::ENDPOINT_LIST . '/xlsx';

    public const ERROR_CODE_1 = 'SVC_EXODUS-RDISCE-0001';

    public const ERROR_MESSAGE_1 = 'Failed to export advertising list from Exodus.';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function detail(
        string $from_month,
        string $to_month,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_DETAIL,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'organization_identifier' => $organization_identifier,
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function export(
        Type $type,
        ?string $search_query = null,
        ?string $organization_identifier = null
    ): string {
        return $this->request(
            endpoint: self::ENDPOINT_LIST_EXPORT,
            data: [
                'filter' => $search_query,
                'otc_type' => $type->value,
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function get(
        string $from_month,
        string $to_month,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_GET,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'organization_identifier' => $organization_identifier,
            ]
        );
    }

    public function iconika(): DiscountsIconikaExodus
    {
        return new DiscountsIconikaExodus;
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function list(
        Type $type,
        ?string $search_query = null,
        ?int $page = null,
        ?int $per_page = null,
        ?string $organization_identifier = null
    ): array {
        PaginationValidator::validate($page, $per_page);

        return $this->request(
            endpoint: self::ENDPOINT_LIST,
            data: [
                'filter' => $search_query,
                'otc_type' => $type->value,
                'page' => $page,
                'per_page' => $per_page,
                'organization_identifier' => $organization_identifier,
            ]
        );
    }
}
