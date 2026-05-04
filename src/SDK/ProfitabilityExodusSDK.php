<?php

namespace ProfitabilityExodus\SDK;

use ProfitabilityExodus\SDK\Core\ExodusFake;
use ProfitabilityExodus\SDK\Resources\AuthorizationExodus;
use ProfitabilityExodus\SDK\Resources\DedicationsAndPaymentsExodus;
use ProfitabilityExodus\SDK\Resources\DiscountsExodus;
use ProfitabilityExodus\SDK\Resources\GenericsExodus;
use ProfitabilityExodus\SDK\Resources\OrganizationExodus;
use ProfitabilityExodus\SDK\Resources\OtcDetailExodus;
use ProfitabilityExodus\SDK\Resources\PvpMarginExodus;
use ProfitabilityExodus\SDK\Resources\ReportsExodus;

class ProfitabilityExodusSDK
{
    use ExodusFake;

    public static function authorization(): AuthorizationExodus
    {
        return new AuthorizationExodus;
    }

    public static function dedicationsAndPayments(): DedicationsAndPaymentsExodus
    {
        return new DedicationsAndPaymentsExodus;
    }

    public static function discounts(): DiscountsExodus
    {
        return new DiscountsExodus;
    }

    public static function generics(): GenericsExodus
    {
        return new GenericsExodus;
    }

    public static function organization(): OrganizationExodus
    {
        return new OrganizationExodus;
    }

    public static function pvpMargin(): PvpMarginExodus
    {
        return new PvpMarginExodus;
    }

    public static function reports(): ReportsExodus
    {
        return new ReportsExodus;
    }

    public static function otcDetail(): OtcDetailExodus
    {
        return new OtcDetailExodus;
    }
}
