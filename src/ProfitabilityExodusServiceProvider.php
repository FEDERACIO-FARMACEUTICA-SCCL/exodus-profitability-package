<?php

namespace ProfitabilityExodus;

use Illuminate\Support\ServiceProvider;

class ProfitabilityExodusServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/profitability-exodus-sdk.php' => config_path('profitability-exodus-sdk.php')
        ], 'profitability-exodus-sdk');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/profitability-exodus-sdk.php', 'profitability-exodus-sdk');
    }
}
