<?php

namespace ProfitabilityExodus\SDK\Fakes;

use Illuminate\Support\Facades\Http;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\SDK\Resources\DedicationsAndPaymentsExodus;

class DedicationsAndPaymentsFake
{
    public const RESPONSE_GET = [
        'dedication' => 999.99,
        'dedication_agreed' => 99.99,
        'dedication_agreed_end' => '2025-12-11T11:48:32.491Z',
        'dedication_logistic' => 99.99,
        'dedication_logistic_end' => '2025-12-11T11:48:32.491Z',
        'amount_paid' => 999.99,
        'outstanding_amount' => 999.99,
        'total_amount' => 999.99,
        'organization_rank_description' => 'Lorem ipsum dolor sit amet'
    ];

    public const RESPONSE_PENDING = [
        'items' => [
            [
                'amount_status' => 'PENDING',
                'date' => '2024-12-11T11:48:32.491Z',
                'delivery_note' => 'DN-0001',
                'laboratory' => 'Lab A',
                'laboratory_name' => 'Laboratory A',
                'amount' => 999.99
            ],
            [
                'amount_status' => 'PENDING',
                'date' => '2024-12-12T11:48:32.491Z',
                'delivery_note' => 'DN-0002',
                'laboratory' => 'Lab B',
                'laboratory_name' => 'Laboratory B',
                'amount' => 99.99
            ]
        ],
        'total_count' => 2,
        'page' => 1,
        'page_size' => 10,
        'total_pages' => 1
    ];

    public const RESPONSE_PENDING_MARK_AS_TRANSFERRED = [
        'message' => 'Transfer marked successfully',
        'updated_count' => 9,
        'delivery_notes_ids' => [9, 99, 999]
    ];

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        Http::fake([
            ProfitabilityExodusSDK::url(DedicationsAndPaymentsExodus::ENDPOINT_GET) . '?*' => Http::response(self::RESPONSE_GET),
            ProfitabilityExodusSDK::url(DedicationsAndPaymentsExodus::ENDPOINT_PENDING) . '*' => Http::response(self::RESPONSE_PENDING),
            ProfitabilityExodusSDK::url(DedicationsAndPaymentsExodus::ENDPOINT_PENDING_MARK_AS_TRANSFERRED) . '*' => Http::response(self::RESPONSE_PENDING_MARK_AS_TRANSFERRED)
        ]);
    }
}
