<?php

namespace ProfitabilityExodus\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public const ROUTES_EXODUS_FAKE = [
        'discounts.free_sales.iconika.categories',
        'discounts.free_sales.iconika.laboratories',
        'discounts.free_sales.iconika.laboratories.export',
        'organization-information',
    ];

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function __construct()
    {
        if (in_array(request()?->route()?->getName(), self::ROUTES_EXODUS_FAKE, true)) {
            ProfitabilityExodusSDK::fake();
        }
    }

    protected function parseBoolQueryParams(?string $value = null, bool $nullable = false, bool $default = true): ?bool
    {
        if (is_null($value) && $nullable) {
            return null;
        }

        if (is_null($value)) {
            return $default;
        }

        return $value === 'true';
    }

    protected function setAuthLocale(): void
    {
        $language_column = config('profitability_exodus-sdk.language_column');
        $auth_language = auth()->user()?->$language_column;
        app()->setLocale(in_array($auth_language, ['es', 'ca']) ? $auth_language : 'es');
    }
}
