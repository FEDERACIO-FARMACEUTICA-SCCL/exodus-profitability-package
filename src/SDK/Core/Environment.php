<?php

namespace ProfitabilityExodus\SDK\Core;

use Labelgrup\LaravelUtilities\Exceptions\CustomException;
use ProfitabilityExodus\SDK\Environments\Development;
use ProfitabilityExodus\SDK\Environments\Production;
use Symfony\Component\HttpFoundation\Response;

class Environment
{
    public const ENVIRONMENT_DEVELOPMENT = 'development';
    public const ENVIRONMENT_PRODUCTION = 'production';

    public const ERROR_ENV_CODE_1 = 'SVC_EXODUS-ENV-0001';

    public const ERROR_DESCRIPTION_ENV_CODE_1 = 'Invalid environment';

    protected string $environment;

    public function __construct(?string $environment = null)
    {
        $this->environment = $this->environment($environment);
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function url(string $endpoint): string
    {
        return (new self)->baseUrl() . $endpoint;
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function baseUrl(): string
    {
        if ($force_base_url = config('profitability-exodus-sdk.force_base_url')) {
            return $force_base_url;
        }

        return $this->environmentClass()::BASE_URL;
    }

    public function get(): string
    {
        return $this->environment;
    }

    protected function environment(?string $environment = null): string
    {
        return $environment ?? config('profitability-exodus-sdk.environment');
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    protected function environmentClass(): string
    {
        switch ($this->environment) {
            case self::ENVIRONMENT_DEVELOPMENT:
                return Development::class;
            case self::ENVIRONMENT_PRODUCTION:
                return Production::class;
        }

        throw new CustomException(
            error_code: self::ERROR_ENV_CODE_1,
            error_message: self::ERROR_DESCRIPTION_ENV_CODE_1,
            http_code: Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
