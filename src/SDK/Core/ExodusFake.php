<?php

namespace ProfitabilityExodus\SDK\Core;

use ProfitabilityExodus\SDK\Fakes\DedicationsAndPaymentsFake;
use ProfitabilityExodus\SDK\Fakes\DiscountsFake;
use ProfitabilityExodus\SDK\Fakes\DiscountsIconikaFake;
use ProfitabilityExodus\SDK\Fakes\GenericsFake;
use ProfitabilityExodus\SDK\Fakes\OrganizationFake;
use ProfitabilityExodus\SDK\Fakes\OtcDetailFake;
use ProfitabilityExodus\SDK\Fakes\PvpMarginFake;
use ProfitabilityExodus\SDK\Fakes\ReportsFake;

trait ExodusFake
{
    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fake(): void
    {
        DedicationsAndPaymentsFake::fake();
        DiscountsFake::fake();
        DiscountsIconikaFake::fake();
        GenericsFake::fake();
        OrganizationFake::fake();
        PvpMarginFake::fake();
        ReportsFake::fake();
        OtcDetailFake::fake();
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function url(string $endpoint): string
    {
        return (new Environment)->baseUrl() . $endpoint;
    }
}
