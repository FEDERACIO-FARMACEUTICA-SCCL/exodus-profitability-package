<?php

namespace ProfitabilityExodus\SDK\Fakes;

use Illuminate\Support\Facades\Http;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\SDK\Resources\PvpMarginExodus;

class PvpMarginFake
{
    public const RESPONSE_GET = [
        'items' => [
            [
                'type' => 'generics',
                'margin_percentage' => 99.9,
                'minimum' => 99.99,
                'median' => 99.99,
                'maximum' => 99.99
            ],
            [
                'type' => 'parapharmacy',
                'margin_percentage' => 99.9,
                'minimum' => 99.99,
                'median' => 99.99,
                'maximum' => 99.99
            ],
            [
                'type' => 'promotional',
                'margin_percentage' => 99.9,
                'minimum' => 99.99,
                'median' => 99.99,
                'maximum' => 99.99
            ],
            [
                'type' => 'all',
                'margin_percentage' => 99.9,
                'minimum' => 99.99,
                'median' => 99.99,
                'maximum' => 99.99
            ],
            [
                'type' => 'all_expensive_excluded',
                'margin_percentage' => 99.9,
                'minimum' => 99.99,
                'median' => 99.99,
                'maximum' => 99.99
            ]
        ],
        'applied_filters' => [
            'organization_identifier' => 'S99999',
            'from_month' => '2025-01',
            'to_month' => '2025-11'
        ]
    ];

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        Http::fake([
            ProfitabilityExodusSDK::url(PvpMarginExodus::ENDPOINT_GET) . '*' => Http::response(self::RESPONSE_GET)
        ]);
    }
}
