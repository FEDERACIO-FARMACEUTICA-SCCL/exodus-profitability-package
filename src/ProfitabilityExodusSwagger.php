<?php

namespace ProfitabilityExodus;

class ProfitabilityExodusSwagger
{
    public const DOCS_ROUTE = 'api-docs/exodus';
    public const DOCS_PATH = 'api-docs/exodus';           // public path (for vendor:publish)
    public const DOCS_STORAGE_PATH = 'exodus';             // storage/api-docs/exodus
    public const OAUTH2_CALLBACK = 'api/exodus/callback';

    public static function config(
        string $title = 'Exodus Profitability API',
        string $route = 'api/exodus/documentation',
        array $servers = []
    ): array {
        return [
            'api' => [
                'title' => $title,
            ],
            'routes' => [
                'api' => $route,
                'docs' => self::DOCS_ROUTE,
                'oauth2_callback' => self::OAUTH2_CALLBACK,
            ],
            'paths' => [
                'use_absolute_path' => env('L5_SWAGGER_USE_ABSOLUTE_PATH', true),
                'docs' => storage_path('api-docs/' . self::DOCS_STORAGE_PATH),
                'docs_json' => 'api-docs.json',
                'docs_yaml' => 'api-docs.yaml',
                'format_to_use_for_docs' => env('L5_FORMAT_TO_USE_FOR_DOCS', 'json'),
                'servers' => $servers,
            ],
        ];
    }
}
