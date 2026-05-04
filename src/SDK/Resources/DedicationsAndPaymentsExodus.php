<?php

namespace ProfitabilityExodus\SDK\Resources;

use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Validators\DatesValidator;
use ProfitabilityExodus\SDK\Validators\PaginationValidator;

class DedicationsAndPaymentsExodus extends BaseExodus
{
    public const ENDPOINT_GET = '/Payments/info';
    public const ENDPOINT_PENDING = '/Payments/transfer_info';
    public const ENDPOINT_PENDING_MARK_AS_TRANSFERRED = '/Payments/transfer_launch';

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
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function pending(
        string $from_month,
        string $to_month,
        int $page = self::DEFAULT_PAGE,
        int $per_page = self::DEFAULT_PER_PAGE,
        ?string $organization_identifier = null
    ): array {
        DatesValidator::fromMonthAndToMonth($from_month, $to_month);
        PaginationValidator::validate($page, $per_page);

        return $this->request(
            endpoint: self::ENDPOINT_PENDING,
            data: [
                'from_month' => $from_month,
                'to_month' => $to_month,
                'page' => $page,
                'per_page' => $per_page,
                'organization_identifier' => $organization_identifier
            ]
        );
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function pendingMarkAsTransferred(?string $organization_identifier = null): array
    {
        return $this->request(
            endpoint: self::ENDPOINT_PENDING_MARK_AS_TRANSFERRED,
            method: self::METHOD_POST,
            data: ['organization_identifier' => $organization_identifier]
        );
    }
}
