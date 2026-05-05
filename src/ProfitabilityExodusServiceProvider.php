<?php

namespace ProfitabilityExodus;

use Illuminate\Support\ServiceProvider;

class ProfitabilityExodusServiceProvider extends ServiceProvider
{
    /**
     * @throws \JsonException
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/profitability-exodus-sdk.php' => config_path('profitability-exodus-sdk.php'),
        ], 'profitability-exodus-sdk');
        $this->publishSwagger();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/profitability-exodus-sdk.php', 'profitability-exodus-sdk');
    }

    /**
     * @throws \JsonException
     */
    private function publishSwagger(): void
    {
        $docs_path = storage_path('api-docs/' . ProfitabilityExodusSwagger::DOCS_STORAGE_PATH);
        $this->makeFolder($docs_path);
        $source_path = __DIR__ . '/../swagger/api-docs.json';
        $destination_path = $docs_path . '/api-docs.json';

        if (!file_exists($destination_path) || filemtime($source_path) > filemtime($destination_path)) {
            copy($source_path, $destination_path);
        }

        $configured_servers = config('l5-swagger.documentations.exodus.paths.servers', []);

        if (empty($configured_servers)) {
            return;
        }

        $content = file_get_contents($destination_path);
        $json = $content !== false ? json_decode($content, true, 512, JSON_THROW_ON_ERROR) : null;

        if ($json === null) {
            return;
        }

        $json['servers'] = $configured_servers;

        file_put_contents($destination_path, json_encode(
            $json,
            JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ), LOCK_EX);
    }

    private function makeFolder(string $folder): void
    {
        if (is_dir($folder)) {
            return;
        }

        if (!mkdir($folder, 0755, true) && !is_dir($folder)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $folder));
        }
    }
}
