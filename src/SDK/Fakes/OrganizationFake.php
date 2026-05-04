<?php

namespace ProfitabilityExodus\SDK\Fakes;

use Illuminate\Support\Facades\Http;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\SDK\Resources\OrganizationExodus;

class OrganizationFake
{
    public const RESPONSE_INFORMATION = [
        'type' => 'ICON',
        'current_month_visible' => false,
        'has_sellout' => true,
        'comercial_organization_type' => 'SELLOUT_ICONIKA'
    ];

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        Http::fake([
            ProfitabilityExodusSDK::url(OrganizationExodus::ENDPOINT_INFORMATION) . '*' => Http::response(self::RESPONSE_INFORMATION),
        ]);
    }
}
