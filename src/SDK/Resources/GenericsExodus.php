<?php

namespace ProfitabilityExodus\SDK\Resources;

use Illuminate\Support\Str;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Enums\Generic\Type;
use ProfitabilityExodus\SDK\Validators\DatesValidator;

class GenericsExodus extends BaseExodus
{
    public const ENDPOINT_DETAIL = '/Generics/';
    public const ENDPOINT_LIST = '/Generics/list';
    public const ENDPOINT_LIST_EXPORT = self::ENDPOINT_LIST . '/xlsx';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function detail(
        Type $type,
        ?string $organization_identifier = null
    ): array {
        return $this->request(
            endpoint: self::ENDPOINT_DETAIL . Type::toExodus($type),
            data: [
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function export(
        string $from_month,
        string $to_month,
        ?string $search_query = null,
        ?string $organization_identifier = null
    ): string {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_LIST_EXPORT,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'filter' => Str::upper($search_query),
                'organization_identifier' => $organization_identifier,
                'language' => auth()->user()->language
            ],
            response_type: self::RESPONSE_XLSX
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function list(
        string $from_month,
        string $to_month,
        ?string $search_query = null,
        ?int $page = null,
        ?int $per_page = null,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);

        return $this->request(
            endpoint: self::ENDPOINT_LIST,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'filter' => Str::upper($search_query),
                'organization_identifier' => $organization_identifier,
                'page' => $page,
                'per_page' => $per_page
            ]
        );
    }
}
