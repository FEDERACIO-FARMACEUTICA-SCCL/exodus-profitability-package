<?php

namespace ProfitabilityExodus\SDK\Fakes;

use Illuminate\Support\Facades\Http;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\SDK\Resources\DiscountsExodus;

class DiscountsFake
{
    use FakeExportTrait;

    public const RESPONSE_DETAIL = [
        'headers' => [
            [
                'concept' => 'total_discount_generics',
                'year' => 2025,
                'month' => 1,
                'discount_amount' => 9999.99,
                'products_with_discount' => null
            ],
            [
                'concept' => 'total_discount_promotional',
                'year' => 2025,
                'month' => 1,
                'discount_amount' => 9999.99,
                'products_with_discount' => null
            ],
            [
                'concept' => 'total_discount_parapharmacy',
                'year' => 2025,
                'month' => 1,
                'discount_amount' => 9999.99,
                'products_with_discount' => null
            ]
        ],
        'applied_filters' => [
            'organization_identifier' => 'S77776',
            'from_month' => '2025-01',
            'to_month' => '2025-11'
        ]
    ];

    public const RESPONSE_GET = [
        'company_discount' => 9999.99,
        'company_discount_percentage' => 99.9
    ];

    public const RESPONSE_LIST = [
        'items' => [
            [
                'national_code' => 'CN001',
                'description' => 'Advertising Campaign 1',
                'laboratory_name' => 'Lab A',
                'taxes' => 21.0,
                'pvl' => 9999.99,
                'discount_percentage' => 99.9,
                'discount_origin' => 'Origin discount 1',
                'price' => 99.99
            ],
            [
                'national_code' => 'CN002',
                'description' => 'Advertising Campaign 2',
                'laboratory_name' => 'Lab B',
                'taxes' => 10.0,
                'pvl' => 9999.99,
                'discount_percentage' => 99.9,
                'discount_origin' => 'Origin discount 2',
                'price' => 99.99
            ]
        ],
        'total_count' => 2,
        'page' => 1,
        'page_size' => 10,
        'total_pages' => 1
    ];

    public const RESPONSE_LIST_EXPORT = 'examples/discounts/list.xlsx';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        Http::fake([
            ProfitabilityExodusSDK::url(DiscountsExodus::ENDPOINT_DETAIL) . '?*' => Http::response(self::RESPONSE_DETAIL),
            ProfitabilityExodusSDK::url(DiscountsExodus::ENDPOINT_GET) . '?*' => Http::response(self::RESPONSE_GET),
            ProfitabilityExodusSDK::url(DiscountsExodus::ENDPOINT_LIST) . '?*' => Http::response(self::RESPONSE_LIST),
            ProfitabilityExodusSDK::url(DiscountsExodus::ENDPOINT_LIST_EXPORT) . '?*' => self::responseExport(self::RESPONSE_LIST_EXPORT)
        ]);
    }
}
