<?php

namespace ProfitabilityExodus\SDK\Resources;

class AuthorizationExodus
{
    public function apiKey(): string
    {
        return config('profitability-exodus-sdk.api_key');
    }
}
