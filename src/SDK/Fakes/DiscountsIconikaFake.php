<?php

namespace ProfitabilityExodus\SDK\Fakes;

use Illuminate\Support\Facades\Http;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\SDK\Resources\DiscountsIconikaExodus;

class DiscountsIconikaFake
{
    use FakeExportTrait;

    public const RESPONSE_CATEGORIES = [
       'categories' => [
            [
                'name' => 'Category 1',
                'value' => 9999.99
            ],
            [
                'name' => 'Category 2',
                'value' => 9999.99
            ]
       ]
    ];

    public const RESPONSE_LABORATORIES = [
        'laboratories' => [
            [
                'laboratory_name' => 'Lab A',
                'laboratory_fee_percentage' => 99.9,
                'sales_family_pvl' => 999.99,
                'sales_laboratory_pvl' => 999.99,
                'commitment_fee_percentage' => 99.9,
                'commitment_index' => 999,
                'section' => 'A',
                'laboratory_discount' => -9.9,
                'opportunity' => null
            ],
            [
                'laboratory_name' => 'Lab B',
                'laboratory_fee_percentage' => 99.9,
                'sales_family_pvl' => 999.99,
                'sales_laboratory_pvl' => 999.99,
                'commitment_fee_percentage' => 99.9,
                'commitment_index' => 999,
                'section' => 'B',
                'laboratory_discount' => -9.9,
                'opportunity' => null
            ]
        ],
        'total_count' => 2,
        'page' => 1,
        'page_size' => 10,
        'total_pages' => 1
    ];

    public const RESPONSE_LABORATORIES_EXPORT = 'examples/discounts/iconika/laboratories.xlsx';

    public const RESPONSE_PRODUCTS = [
        'items' => [
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ],
            [
                'internal_code' => '99999999',
                'product_national_code' => '9999999',
                'product_description' => 'PRODUCTO FAKE 999',
                'laboratory_identifier' => 'P99999',
                'laboratory_name' => 'LAB FAKE 999',
                'product_vat' => 99,
                'product_pvl' => 9999.99,
                'discount_percentage' => 99,
                'product_net_price' => 9999.99,
                'discount_origin' => 'FAKE'
            ]
        ],
        'total_count' => 99999,
        'page' => 1,
        'per_page' => 99,
        'total_pages' => 9999,
        'applied_filters' => [
            'organization_identifier' => 'S99999',
            'otc_type' => 'PARAPHARMACY',
            'product_classification_identifier' => '9'
        ]
    ];


    public const RESPONSE_PRODUCTS_EXPORT = 'examples/discounts/iconika/products.xlsx';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        Http::fake([
            ProfitabilityExodusSDK::url(DiscountsIconikaExodus::ENDPOINT_CATEGORIES) . '*' => Http::response(self::RESPONSE_CATEGORIES),
            ProfitabilityExodusSDK::url(DiscountsIconikaExodus::ENDPOINT_LABORATORIES) . '?*' => Http::response(self::RESPONSE_LABORATORIES),
            ProfitabilityExodusSDK::url(DiscountsIconikaExodus::ENDPOINT_LABORATORIES_EXPORT) . '?*' => self::responseExport(self::RESPONSE_LABORATORIES_EXPORT),
            ProfitabilityExodusSDK::url(DiscountsIconikaExodus::ENDPOINT_PRODUCTS) . '?*' => Http::response(self::RESPONSE_PRODUCTS),
            ProfitabilityExodusSDK::url(DiscountsIconikaExodus::ENDPOINT_PRODUCTS_EXPORT) . '?*' => self::responseExport(self::RESPONSE_PRODUCTS_EXPORT)
        ]);
    }
}
