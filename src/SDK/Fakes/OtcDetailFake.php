<?php

namespace ProfitabilityExodus\SDK\Fakes;

use Illuminate\Support\Facades\Http;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\SDK\Resources\OtcDetailExodus;

class OtcDetailFake
{
    public const RESPONSE_GET = [
        'pharmacy_summary' => [
            'billing_amount' => 0,
            'fedefarma_purchase_rotation' => 0,
            'direct_purchase_rotation' => 0
        ],
        'items' => [
            [
                'type' => 'string',
                'margin_percentage' => 0,
                'discount_breakdown' => [
                    [
                        'discount_origin' => 'string',
                        'relative_weight' => 0
                    ]
                ],
                'rotation' => 0,
                'profitability_index' => 0,
                'benefit_amount' => 0,
                'stock_amount' => 0,
                'stock_profitability_index' => 0
            ]
        ],
        'data_reliability' => true,
        'applied_filters' => [
            'organization_identifier' => 'string',
            'otc_type' => 'string'
        ]
    ];

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        Http::fake([
            ProfitabilityExodusSDK::url(OtcDetailExodus::ENDPOINT_GET) . '*' => Http::response(self::RESPONSE_GET)
        ]);
    }
}
