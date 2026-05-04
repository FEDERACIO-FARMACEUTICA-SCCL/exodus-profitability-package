<?php

return [
    'environment' => env('PROFITABILITY_EXODUS_ENVIRONMENT', 'production'),
    'api_key' => env('PROFITABILITY_EXODUS_API_KEY'),
    'force_base_url' => env('PROFITABILITY_EXODUS_FORCE_BASE_URL'),
    'user_language_column' => 'language',
    'timeout' => 120
];
