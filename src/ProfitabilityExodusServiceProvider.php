<?php

namespace ProfitabilityExodus;

use FilesystemIterator;
use Illuminate\Support\ServiceProvider;

class ProfitabilityExodusServiceProvider extends ServiceProvider
{
    /**
     * @throws \JsonException
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/profitability-exodus-sdk.php' => config_path('profitability-exodus-sdk.php')
        ], 'profitability-exodus-sdk');
        $this->publishSwagger();
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/profitability-exodus-sdk.php', 'profitability-exodus-sdk');
    }

    private function copyDirectory(string $source, string $dest): void
    {
        $this->makeFolder($dest);
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            $target = $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathname();

            if ($item->isDir()) {
                $this->makeFolder($target);
                continue;
            }

            copy($item->getPathname(), $target);
        }
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

    /**
     * @throws \JsonException
     */
    private function publishSwagger(): void
    {
        $source = __DIR__ . '/../swagger';
        $dest = public_path('api-docs/' . ProfitabilityExodusSwagger::DOCS_STORAGE_PATH);
        $dest_file = $dest . '/api-docs.json';

        $this->copyDirectory($source, $dest);

        $configured_servers = config('l5-swagger.documentations.exodus.paths.servers', []);

        if (empty($configured_servers)) {
            return;
        }

        $json = json_decode(file_get_contents($dest_file), true, 512, JSON_THROW_ON_ERROR);
        $json['servers'] = $configured_servers;
        file_put_contents(
            $dest_file,
            json_encode($json, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );
    }
}
