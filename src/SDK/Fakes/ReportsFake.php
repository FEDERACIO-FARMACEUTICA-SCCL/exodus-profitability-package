<?php

namespace ProfitabilityExodus\SDK\Fakes;

use Illuminate\Support\Facades\Http;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\SDK\Resources\ReportsExodus;

class ReportsFake
{
    use FakeExportTrait;

    public const RESPONSE_DISCOUNTS = [
        'concepts' => [
            [
                'concept' => 'Total invoices',
                'super_reduced' => 76804.18,
                'reduced' => 19181.96,
                'standard' => 7463.02,
                'discount_percentage' => null,
                'total' => 103449.16,
                'items' => [
                    [
                        'concept' => 'Company discount',
                        'super_reduced' => -5302.47,
                        'reduced' => -342.36,
                        'standard' => -256.34,
                        'discount_percentage' => 18.31,
                        'total' => -5901.17
                    ],
                    [
                        'concept' => 'Industry discount',
                        'super_reduced' => -10934.81,
                        'reduced' => -3664.27,
                        'standard' => -1465.76,
                        'discount_percentage' => 49.83,
                        'total' => -16064.84
                    ],
                    [
                        'concept' => 'Generics Club Rappel',
                        'super_reduced' => -2713.28,
                        'reduced' => 0,
                        'standard' => 0,
                        'discount_percentage' => 8.42,
                        'total' => -2713.28
                    ],
                    [
                        'concept' => 'Others',
                        'super_reduced' => -7557.8,
                        'reduced' => 0,
                        'standard' => 0,
                        'discount_percentage' => 23.44,
                        'total' => -7557.8
                    ],
                    [
                        "concept" => 'Integration',
                        "super_reduced" => 0,
                        "reduced" => 0,
                        "standard" => 0,
                        "discount_percentage" => 0,
                        "total" => 0
                    ]
                ]
            ],
            [
                'concept' => 'Total liquidations',
                'super_reduced' => -26508.36,
                'reduced' => -4006.63,
                'standard' => -1722.1,
                'discount_percentage' => 25.7,
                'total' => -32237.09
            ]
        ]
    ];

    public const RESPONSE_DISCOUNTS_EXPORT = 'examples/reports/discounts.xlsx';

    public const RESPONSE_DISCOUNTS_SUMMARY = [
        'concepts' => [
            [
                'concept' => 'Total invoices',
                'super_reduced' => null,
                'reduced' => null,
                'standard' => null,
                'discount_percentage' => null,
                'total' => 99.99,
                'items' => [
                    [
                        'concept' => 'Company discount',
                        'super_reduced' => null,
                        'reduced' => null,
                        'standard' => null,
                        'discount_percentage' => null,
                        'total' => 99.99
                    ],
                    [
                        'concept' => 'Industry discount',
                        'super_reduced' => null,
                        'reduced' => null,
                        'standard' => null,
                        'discount_percentage' => null,
                        'total' => 99.99
                    ],
                    [
                        'concept' => 'Generics Club Rappel',
                        'super_reduced' => null,
                        'reduced' => null,
                        'standard' => null,
                        'discount_percentage' => null,
                        'total' => 99.99
                    ],
                    [
                        'concept' => 'Others',
                        'super_reduced' => null,
                        'reduced' => null,
                        'standard' => null,
                        'discount_percentage' => null,
                        'total' => 99.99
                    ]
                ]
            ],
            [
                'concept' => 'Total liquidations',
                'super_reduced' => null,
                'reduced' => null,
                'standard' => null,
                'discount_percentage' => null,
                'total' => 99.99
            ]
        ]
    ];

    public const RESPONSE_DISCOUNTS_SUMMARY_EXPORT = 'examples/reports/discounts_summary.xlsx';

    public const RESPONSE_FREE_SALES = [
        'items' => [
            [
                'concept' => 'gross_amount_at_psp',
                'transfer_direct' => 99.99,
                'restocking' => 999.99,
                'total' => 999.99,
                'percentage_over_total' => 99.99,
                'children' => [
                    [
                        'concept' => 'company_discounts_on_delivery_note',
                        'transfer_direct' => 99.99,
                        'restocking' => 99.99,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'falc_discounts_on_delivery_note',
                        'transfer_direct' => null,
                        'restocking' => 99.99,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'cfi_discounts_on_delivery_note',
                        'transfer_direct' => null,
                        'restocking' => 99.99,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'others_discounts_on_delivery_note',
                        'transfer_direct' => null,
                        'restocking' => 99.99,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'industry_discounts_on_delivery_note',
                        'transfer_direct' => 99.99,
                        'restocking' => null,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'other_credits_to_financial_account',
                        'transfer_direct' => null,
                        'restocking' => null,
                        'total' => 0,
                        'percentage_over_total' => 0
                    ]
                ]
            ],
            [
                'concept' => 'total_discounts',
                'transfer_direct' => null,
                'restocking' => null,
                'total' => 999.99,
                'percentage_over_total' => 99.99
            ]
        ],
        'applied_filters' => [
            'organization_identifier' => 'S77776',
            'year' => 2025,
            'months' => [12],
            'laboratory_identifier' => null,
            'otc_type' => 'PARAPHARMACY'
        ]
    ];

    public const RESPONSE_FILTERS = [
        'from_month' => '2025-01',
        'to_month' => '2025-12',
        'laboratories' => [
            [
                'laboratory_identifier' => 'P02725',
                'laboratory_name' => 'BEXAL FARMACEUTICA, S.A.'
            ],
            [
                'laboratory_identifier' => 'P09902',
                'laboratory_name' => 'CINFA S.A., LABORATORIOS'
            ],
            [
                'laboratory_identifier' => 'P03491',
                'laboratory_name' => 'KERN PHARMA, S.L.'
            ],
            [
                'laboratory_identifier' => 'P09167',
                'laboratory_name' => 'NEURAXPHARM SPAIN, S.L.'
            ],
            [
                'laboratory_identifier' => 'P05520',
                'laboratory_name' => 'NORMON S.A., LABORATORIOS'
            ],
            [
                'laboratory_identifier' => 'P11007',
                'laboratory_name' => 'SANDOZ FARMACEUTICA, S.A.'
            ],
            [
                'laboratory_identifier' => 'P10470',
                'laboratory_name' => 'STADA, S.L., LABORATORIO'
            ],
            [
                'laboratory_identifier' => 'P06866',
                'laboratory_name' => 'TEVA PHARMA S.L.U.'
            ],
            [
                'laboratory_identifier' => 'P08169',
                'laboratory_name' => 'TOWA PHARMACEUTICAL, S.A.'
            ],
            [
                'laboratory_identifier' => 'P04903',
                'laboratory_name' => 'VIATRIS PHARMACEUTICALS, S.L. UNIPERSONAL'
            ]
        ],
        'total_laboratories' => 10,
        'page' => 1,
        'page_size' => 50,
        'total_pages' => 1
    ];

    public const RESPONSE_FREE_SALES_EXPORT = 'examples/reports/free_sales.xlsx';

    public const RESPONSE_FREE_SALES_SUMMARY = [
        'items' => [
            [
                'concept' => 'gross_amount_at_psp',
                'transfer_direct' => 99.99,
                'restocking' => 999.99,
                'total' => 999.99,
                'percentage_over_total' => 99.99,
                'children' => [
                    [
                        'concept' => 'company_discounts_on_delivery_note',
                        'transfer_direct' => 99.99,
                        'restocking' => 99.99,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'falc_discounts_on_delivery_note',
                        'transfer_direct' => null,
                        'restocking' => 99.99,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'cfi_discounts_on_delivery_note',
                        'transfer_direct' => null,
                        'restocking' => 99.99,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'others_discounts_on_delivery_note',
                        'transfer_direct' => null,
                        'restocking' => 99.99,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'industry_discounts_on_delivery_note',
                        'transfer_direct' => 99.99,
                        'restocking' => null,
                        'total' => 99.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'other_credits_to_financial_account',
                        'transfer_direct' => null,
                        'restocking' => null,
                        'total' => 0,
                        'percentage_over_total' => 0
                    ]
                ]
            ],
            [
                'concept' => 'total_discounts',
                'transfer_direct' => null,
                'restocking' => null,
                'total' => 999.99,
                'percentage_over_total' => 99.99
            ]
        ],
        'applied_filters' => [
            'organization_identifier' => 'S77776',
            'year' => 2025,
            'months' => [12],
            'laboratory_identifier' => null,
            'otc_type' => null
        ]
    ];

    public const RESPONSE_FREE_SALES_SUMMARY_EXPORT = 'examples/reports/free_sales_summary.xlsx';

    public const RESPONSE_GENERICS = [
        'items' => [
            [
                'concept' => 'gross_amount_at_psp',
                'transfer_direct' => 99.99,
                'restocking' => 999.99,
                'total' => 999.99,
                'percentage_over_total' => 99.99,
                'children' => [
                    [
                        'concept' => 'generics_club_total_rebate',
                        'transfer_direct' => 99.99,
                        'restocking' => 99.99,
                        'total' => 999.99,
                        'percentage_over_total' => 99.99,
                        'children' => [
                            [
                                'concept' => 'company_discounts_on_delivery_note',
                                'transfer_direct' => 99.99,
                                'restocking' => 99.99,
                                'total' => 999.99,
                                'percentage_over_total' => 99.99
                            ],
                            [
                                'concept' => 'generics_club_rebate_to_financial_account',
                                'transfer_direct' => null,
                                'restocking' => null,
                                'total' => 0,
                                'percentage_over_total' => 0
                            ]
                        ]
                    ],
                    [
                        'concept' => 'industry_discounts_on_delivery_note',
                        'transfer_direct' => 99.99,
                        'restocking' => 99.99,
                        'total' => 999.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'tier_adjustments_to_financial_account',
                        'transfer_direct' => null,
                        'restocking' => null,
                        'total' => 0,
                        'percentage_over_total' => 0
                    ],
                    [
                        'concept' => 'extra_adjustments_to_financial_account',
                        'transfer_direct' => null,
                        'restocking' => null,
                        'total' => 0,
                        'percentage_over_total' => 0
                    ]
                ]
            ],
            [
                'concept' => 'total_discounts',
                'transfer_direct' => null,
                'restocking' => null,
                'total' => 999.99,
                'percentage_over_total' => 99.99
            ]
        ],
        'applied_filters' => [
            'organization_identifier' => 'S77776',
            'year' => 2025,
            'months' => [12],
            'laboratory_identifier' => 'P05520',
            'type' => null
        ]
    ];

    public const RESPONSE_GENERICS_EXPORT = 'examples/reports/generics.xlsx';

    public const RESPONSE_GENERICS_SUMMARY = [
        'items' => [
            [
                'concept' => 'gross_amount_at_psp',
                'transfer_direct' => 999.99,
                'restocking' => 99.99,
                'total' => 999.99,
                'percentage_over_total' => 99.99,
                'children' => [
                    [
                        'concept' => 'generics_club_total_rebate',
                        'transfer_direct' => 99.99,
                        'restocking' => 99.99,
                        'total' => 999.99,
                        'percentage_over_total' => 99.99,
                        'children' => [
                            [
                                'concept' => 'company_discounts_on_delivery_note',
                                'transfer_direct' => 99.99,
                                'restocking' => 99.99,
                                'total' => 999.99,
                                'percentage_over_total' => 99.99
                            ],
                            [
                                'concept' => 'generics_club_rebate_to_financial_account',
                                'transfer_direct' => null,
                                'restocking' => null,
                                'total' => 99,
                                'percentage_over_total' => 99
                            ]
                        ]
                    ],
                    [
                        'concept' => 'industry_discounts_on_delivery_note',
                        'transfer_direct' => 999.99,
                        'restocking' => 99.99,
                        'total' => 999.99,
                        'percentage_over_total' => 99.99
                    ],
                    [
                        'concept' => 'tier_adjustments_to_financial_account',
                        'transfer_direct' => null,
                        'restocking' => null,
                        'total' => 99,
                        'percentage_over_total' => 99
                    ],
                    [
                        'concept' => 'extra_adjustments_to_financial_account',
                        'transfer_direct' => null,
                        'restocking' => null,
                        'total' => 99,
                        'percentage_over_total' => 99
                    ]
                ]
            ],
            [
                'concept' => 'total_discounts',
                'transfer_direct' => null,
                'restocking' => null,
                'total' => 999.99,
                'percentage_over_total' => 99.99
            ]
        ],
        'applied_filters' => [
            'organization_identifier' => 'S77776',
            'year' => 2025,
            'months' => [12],
            'laboratory_identifier' => null,
            'type' => null
        ]
    ];

    public const RESPONSE_GENERICS_SUMMARY_EXPORT = 'examples/reports/generics_summary.xlsx';

    public const RESPONSE_MARGINS = [
        'categories' => [
            [
                'category_group' => 'Especialitat',
                'items' => [
                    [
                        'category' => 'Medicamentos',
                        'category_identifier' => '1_NO_RD',
                        'billing_amount' => 99.99,
                        'billing_percentage' => 99.99,
                        'margin' => 99.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 999.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 999.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ],
                    [
                        'category' => 'E.F.G.',
                        'category_identifier' => '2',
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 0,
                            'billing_percentage' => 0,
                            'margin_amount' => 0,
                            'margin_percentage' => 0,
                            'pharmacy_count' => 0
                        ]
                    ],
                    [
                        'category' => 'E.F.P / OTC',
                        'category_identifier' => '3',
                        'billing_amount' => 99.99,
                        'billing_percentage' => 99.99,
                        'margin' => 99.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 0,
                            'billing_percentage' => 0,
                            'margin_amount' => 0,
                            'margin_percentage' => 0,
                            'pharmacy_count' => 0
                        ]
                    ],
                    [
                        'category' => 'TOTAL',
                        'category_identifier' => null,
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 999.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 999.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ]
                ]
            ],
            [
                'category_group' => 'Parafarmacia',
                'items' => [
                    [
                        'category' => 'PARAFARMACIA',
                        'category_identifier' => '8',
                        'billing_amount' => 99.99,
                        'billing_percentage' => 99.99,
                        'margin' => 99.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 0,
                            'billing_percentage' => 0,
                            'margin_amount' => 0,
                            'margin_percentage' => 0,
                            'pharmacy_count' => 0
                        ]
                    ],
                    [
                        'category' => 'TOTAL',
                        'category_identifier' => null,
                        'billing_amount' => 99.99,
                        'billing_percentage' => 99.99,
                        'margin' => 99.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 0,
                            'billing_percentage' => 0,
                            'margin_amount' => 0,
                            'margin_percentage' => 0,
                            'pharmacy_count' => 0
                        ]
                    ]
                ]
            ]
        ],
        'totals' => [
            'general' => [
                'category' => 'TOTAL GENERAL',
                'category_identifier' => null,
                'billing_amount' => 999.99,
                'billing_percentage' => 99.99,
                'margin' => 999.99,
                'margin_percentage' => 99.99,
                'market_median' => [
                    'billing_amount' => 999.99,
                    'billing_percentage' => 99.99,
                    'margin_amount' => 999.99,
                    'margin_percentage' => 99.99,
                    'pharmacy_count' => 99
                ]
            ],
            'without_expensive_medicines' => [
                'category' => 'TOTAL SIN RD',
                'category_identifier' => null,
                'billing_amount' => 999.99,
                'billing_percentage' => 99.99,
                'margin' => 999.99,
                'margin_percentage' => 99.99,
                'market_median' => [
                    'billing_amount' => 999.99,
                    'billing_percentage' => 99.99,
                    'margin_amount' => 999.99,
                    'margin_percentage' => 99.99,
                    'pharmacy_count' => 99
                ]
            ]
        ],
        'total_records' => 99,
        'applied_filters' => [
            'report_type' => 'MARGIN',
            'from_month' => '2025-01',
            'to_month' => '2025-01',
            'organization_identifier' => 'S77776',
            'laboratory_identifier' => 'P00001'
        ]
    ];

    public const RESPONSE_MARGINS_EXPORT = 'examples/reports/margins.xlsx';

    public const RESPONSE_MARGINS_SUMMARY = [
        'categories' => [
            [
                'category_group' => 'Especialitat',
                'items' => [
                    [
                        'category' => 'Medicamentos',
                        'category_identifier' => '1_NO_RD',
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 999.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 999.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ],
                    [
                        'category' => 'Medicamentos caros',
                        'category_identifier' => '1_RD',
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 999.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 999.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ],
                    [
                        'category' => 'E.F.G.',
                        'category_identifier' => '2',
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 0,
                            'billing_percentage' => 0,
                            'margin_amount' => 0,
                            'margin_percentage' => 0,
                            'pharmacy_count' => 0
                        ]
                    ],
                    [
                        'category' => 'E.F.P / OTC',
                        'category_identifier' => '3',
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 0,
                            'billing_percentage' => 0,
                            'margin_amount' => 0,
                            'margin_percentage' => 0,
                            'pharmacy_count' => 0
                        ]
                    ],
                    [
                        'category' => 'TOTAL',
                        'category_identifier' => null,
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 999.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 999.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ]
                ]
            ],
            [
                'category_group' => 'Parafarmacia',
                'items' => [
                    [
                        'category' => 'DIETOTERAPEUTICOS',
                        'category_identifier' => '620',
                        'billing_amount' => 99.99,
                        'billing_percentage' => 99.99,
                        'margin' => 99.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 99.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 99.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ],
                    [
                        'category' => 'INCONTINENCIA GRAVE',
                        'category_identifier' => '630',
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 99.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 999.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 99.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ],
                    [
                        'category' => 'Otros productos sanitarios',
                        'category_identifier' => '6-7',
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 99.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 999.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 999.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ],
                    [
                        'category' => 'PARAFARMACIA',
                        'category_identifier' => '8',
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 0,
                            'billing_percentage' => 0,
                            'margin_amount' => 0,
                            'margin_percentage' => 0,
                            'pharmacy_count' => 0
                        ]
                    ],
                    [
                        'category' => 'TOTAL',
                        'category_identifier' => null,
                        'billing_amount' => 999.99,
                        'billing_percentage' => 99.99,
                        'margin' => 999.99,
                        'margin_percentage' => 99.99,
                        'market_median' => [
                            'billing_amount' => 999.99,
                            'billing_percentage' => 99.99,
                            'margin_amount' => 999.99,
                            'margin_percentage' => 99.99,
                            'pharmacy_count' => 99
                        ]
                    ]
                ]
            ]
        ],
        'totals' => [
            'general' => [
                'category' => 'TOTAL GENERAL',
                'category_identifier' => null,
                'billing_amount' => 999.99,
                'billing_percentage' => 99.99,
                'margin' => 999.99,
                'margin_percentage' => 99.99,
                'market_median' => [
                    'billing_amount' => 999.99,
                    'billing_percentage' => 99.99,
                    'margin_amount' => 999.99,
                    'margin_percentage' => 99.99,
                    'pharmacy_count' => 99
                ]
            ],
            'without_expensive_medicines' => [
                'category' => 'TOTAL SIN RD',
                'category_identifier' => null,
                'billing_amount' => 999.99,
                'billing_percentage' => 99.99,
                'margin' => 999.99,
                'margin_percentage' => 99.99,
                'market_median' => [
                    'billing_amount' => 999.99,
                    'billing_percentage' => 99.99,
                    'margin_amount' => 999.99,
                    'margin_percentage' => 99.99,
                    'pharmacy_count' => 99
                ]
            ]
        ],
        'total_records' => 99,
        'applied_filters' => [
            'report_type' => 'MARGIN',
            'from_month' => '2025-01',
            'to_month' => '2025-01',
            'organization_identifier' => 'S77776',
            'laboratory_identifier' => 'TOTAL_ORGANIZATION'
        ]
    ];

    public const RESPONSE_MARGINS_SUMMARY_EXPORT = 'examples/reports/margins_summary.xlsx';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        Http::fake([
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_DISCOUNTS) . '?*' => Http::response(self::RESPONSE_DISCOUNTS),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_DISCOUNTS_EXPORT) . '?*' => self::responseExport(self::RESPONSE_DISCOUNTS_EXPORT),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_DISCOUNTS_SUMMARY) . '?*' => Http::response(self::RESPONSE_DISCOUNTS_SUMMARY),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_DISCOUNTS_SUMMARY_EXPORT) . '?*' => self::responseExport(self::RESPONSE_DISCOUNTS_SUMMARY_EXPORT),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_FILTERS) . '*' => Http::response(self::RESPONSE_FILTERS),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_FREE_SALES) . '?*' => Http::response(self::RESPONSE_FREE_SALES),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_FREE_SALES_EXPORT) . '?*' => self::responseExport(self::RESPONSE_FREE_SALES_EXPORT),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_FREE_SALES_SUMMARY) . '?*' => Http::response(self::RESPONSE_FREE_SALES_SUMMARY),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_FREE_SALES_SUMMARY_EXPORT) . '?*' => self::responseExport(self::RESPONSE_FREE_SALES_SUMMARY_EXPORT),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_GENERICS) . '?*' => Http::response(self::RESPONSE_GENERICS),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_GENERICS_EXPORT) . '?*' => self::responseExport(self::RESPONSE_GENERICS_EXPORT),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_GENERICS_SUMMARY) . '?*' => Http::response(self::RESPONSE_GENERICS_SUMMARY),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_GENERICS_SUMMARY_EXPORT) . '?*' => self::responseExport(self::RESPONSE_GENERICS_SUMMARY_EXPORT),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_MARGINS) . '?*' => Http::response(self::RESPONSE_MARGINS),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_MARGINS_EXPORT) . '?*' => self::responseExport(self::RESPONSE_MARGINS_EXPORT),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_MARGINS_SUMMARY) . '?*' => Http::response(self::RESPONSE_MARGINS_SUMMARY),
            ProfitabilityExodusSDK::url(ReportsExodus::ENDPOINT_MARGINS_SUMMARY_EXPORT) . '?*' => self::responseExport(self::RESPONSE_MARGINS_SUMMARY_EXPORT)
        ]);
    }
}
