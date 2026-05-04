<?php

namespace ProfitabilityExodus\SDK\Fakes;

use Illuminate\Support\Facades\Http;
use ProfitabilityExodus\SDK\Enums\Generic\Type;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\SDK\Resources\GenericsExodus;

class GenericsFake
{
    use FakeExportTrait;

    public const RESPONSE_DETAIL_ACOFARMA = [
        'purchase_amount' => 0,
        'purchase_quota' => 3.2863,
        'volume_rebate_percentage' => 1,
        'target_percentage_1' => 2.5,
        'target_percentage_2' => 5,
        'target_percentage_3' => 8.5,
        'target_amount_1' => 450,
        'target_amount_2' => 600,
        'target_amount_3' => 1000,
        'volume_rebate_percentage_1' => 1,
        'volume_rebate_percentage_2' => 2,
        'volume_rebate_percentage_3' => 3,
        'applied_filters' => [
            'organization_identifier' => 'S64329'
        ]
    ];

    public const RESPONSE_DETAIL_CONCENTRATION = [
        'concentration_percentage' => 3,
        'concentration_minimum' => 80,
        'concentration' => 86.9592,
        'applied_filters' => [
            'organization_identifier' => 'S77776',
            'year' => 2025,
            'month' => 11,
            'classification' => '2'
        ]
    ];

    public const RESPONSE_DETAIL_GENERIFICATION = [
        'quota' => 74.54,
        'target_1' => 50,
        'target_2' => 57,
        'target_3' => 65,
        'rebate_1' => 2,
        'rebate_2' => 3,
        'rebate_3' => 4,
        'applied_rebate' => 4,
        'applied_filters' => [
            'organization_identifier' => 'S64329',
            'year' => 2025,
            'month' => 11
        ]
    ];

    public const RESPONSE_LIST = [
        'laboratories' => [
            [
                'laboratory_identifier' => 'P00001',
                'laboratory_name' => 'Laboratory 1',
                'laboratory_type' => 'STAR',
                'molecule_type' => 'TOTAL_LABORATORIO',
                'pvf_purchase' => 99.99,
                'discount_percentage' => 99,
                'club_discount_percentage' => 99,
                'volume_rebate_discount_percentage' => 99,
                'molecule_count' => 999,
                'euros_retail_price' => 99.99,
                'euros_retail_price_percentage' => 99.99,
                'margin_percentage' => 99.99,
                'items' => [
                    [
                        'laboratory_identifier' => 'P03491',
                        'laboratory_name' => 'CLUB TOTAL',
                        'molecule_type' => 'CLUB',
                        'pvf_purchase' => 99.99,
                        'discount_percentage' => 99,
                        'club_discount_percentage' => 99,
                        'volume_rebate_discount_percentage' => 99,
                        'molecule_count' => 999
                    ],
                    [
                        'laboratory_identifier' => 'P03491',
                        'laboratory_name' => 'EXCLUDED TOTAL',
                        'molecule_type' => 'EXCLUDED',
                        'pvf_purchase' => 99.99,
                        'discount_percentage' => 99,
                        'club_discount_percentage' => 99,
                        'volume_rebate_discount_percentage' => 99,
                        'molecule_count' => 999
                    ],
                    [
                        'laboratory_identifier' => 'P03491',
                        'laboratory_name' => 'STAR TOTAL',
                        'molecule_type' => 'STAR',
                        'pvf_purchase' => 99.99,
                        'discount_percentage' => 99,
                        'club_discount_percentage' => 99,
                        'volume_rebate_discount_percentage' => 99,
                        'molecule_count' => 999
                    ]
                ]
            ],
            [
                'laboratory_identifier' => 'P00002',
                'laboratory_name' => 'Laboratory 2',
                'laboratory_type' => 'STAR',
                'molecule_type' => 'TOTAL_LABORATORIO',
                'pvf_purchase' => 99.99,
                'discount_percentage' => 99,
                'club_discount_percentage' => 99,
                'volume_rebate_discount_percentage' => 99,
                'molecule_count' => 999,
                'euros_retail_price' => 99.99,
                'euros_retail_price_percentage' => 99.99,
                'margin_percentage' => 99.99
            ],
            [
                'laboratory_identifier' => 'P00003',
                'laboratory_name' => 'Laboratory 3',
                'laboratory_type' => 'CLUB',
                'molecule_type' => 'TOTAL_LABORATORIO',
                'pvf_purchase' => 99.99,
                'discount_percentage' => 99,
                'club_discount_percentage' => 99,
                'volume_rebate_discount_percentage' => 99,
                'molecule_count' => 999,
                'euros_retail_price' => 99.99,
                'euros_retail_price_percentage' => 99.99,
                'margin_percentage' => 99.99
            ]
        ],
        'total' => [
            'pvf_purchase' => 99.99,
            'discount_percentage' => 99,
            'club_discount_percentage' => 99,
            'volume_rebate_discount_percentage' => 99,
            'molecule_count' => 999,
            'euros_retail_price' => 99.99,
            'euros_retail_price_percentage' => 99.99,
            'margin_percentage' => 99.99
        ],
        'applied_filters' => [
            'organization_identifier' => 'S77776',
            'from_month' => '2025-01',
            'to_month' => '2025-11'
        ]
    ];


    public const RESPONSE_LIST_EXPORT = 'examples/generics/list.xlsx';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        Http::fake([
            ProfitabilityExodusSDK::url(GenericsExodus::ENDPOINT_LIST) . '?*' => Http::response(self::RESPONSE_LIST),
            ProfitabilityExodusSDK::url(GenericsExodus::ENDPOINT_LIST_EXPORT) . '?*' => self::responseExport(self::RESPONSE_LIST_EXPORT),
            ProfitabilityExodusSDK::url(GenericsExodus::ENDPOINT_DETAIL . Type::toExodus(Type::ACOFARMA)) . '*' => Http::response(self::RESPONSE_DETAIL_ACOFARMA),
            ProfitabilityExodusSDK::url(GenericsExodus::ENDPOINT_DETAIL . Type::toExodus(Type::CONCENTRATION)) . '*' => Http::response(self::RESPONSE_DETAIL_CONCENTRATION),
            ProfitabilityExodusSDK::url(GenericsExodus::ENDPOINT_DETAIL . Type::toExodus(Type::GENERIFICATION)) . '*' => Http::response(self::RESPONSE_DETAIL_GENERIFICATION)
        ]);
    }
}
