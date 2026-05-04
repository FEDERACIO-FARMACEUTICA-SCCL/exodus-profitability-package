<?php

namespace ProfitabilityExodus\SDK\Core;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Labelgrup\LaravelUtilities\Exceptions\CustomException;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;

class BaseExodus
{
    public const BASE_ERROR_CODE_1 = 'SVC_EXODUS-CORE-0001';
    public const BASE_ERROR_CODE_2 = 'SVC_EXODUS-CORE-0002';
    public const BASE_ERROR_CODE_3 = 'SVC_EXODUS-CORE-0003';
    public const BASE_ERROR_CODE_4 = 'SVC_EXODUS-CORE-0004';

    public const BASE_ERROR_MESSAGE_2 = 'Invalid method';
    public const BASE_ERROR_MESSAGE_4 = 'Response type not supported';

    public const CACHE_API_KEY_NAME = 'EXODUS_API_KEY';
    public const CACHE_API_KEY_TTL = 3600;

    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_PATCH = 'PATCH';
    public const METHOD_DELETE = 'DELETE';

    public const METHODS_AVAILABLE = [
        self::METHOD_GET,
        self::METHOD_POST,
        self::METHOD_PUT,
        self::METHOD_PATCH,
        self::METHOD_DELETE,
    ];

    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PER_PAGE = 10;

    public const DEFAULT_TIMEOUT = 120;

    public const RESPONSE_ASYNC = 'async';
    public const RESPONSE_IMAGE = 'image';
    public const RESPONSE_JSON = 'json';
    public const RESPONSE_NONE = 'none';
    public const RESPONSE_PDF = 'pdf';
    public const RESPONSE_XLSX = 'xlsx';
    public const RESPONSE_STATUS = 'status';
    public const RESPONSE_WITH_STATUS = 'with_status';
    public const RESPONSES_ALLOWED = [
        self::RESPONSE_ASYNC,
        self::RESPONSE_PDF,
        self::RESPONSE_JSON,
        self::RESPONSE_IMAGE,
        self::RESPONSE_NONE,
        self::RESPONSE_XLSX,
        self::RESPONSE_STATUS,
        self::RESPONSE_WITH_STATUS
    ];

    public const SORT_DIRECTION_ASC = 'ASC';
    public const SORT_DIRECTION_DESC = 'DESC';
    public const SORT_DIRECTIONS_ALLOWED = [
        self::SORT_DIRECTION_ASC,
        self::SORT_DIRECTION_DESC,
    ];

    public const STATUSES_NOT_TRANSFORM = [
        \Symfony\Component\HttpFoundation\Response::HTTP_NOT_ACCEPTABLE,
        \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND
    ];

    public const STATUS_WITH_MESSAGE = [
        \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND,
        \Symfony\Component\HttpFoundation\Response::HTTP_UNPROCESSABLE_ENTITY,
        \Symfony\Component\HttpFoundation\Response::HTTP_NOT_ACCEPTABLE,
    ];

    protected Environment $environment;

    protected int $timeout;

    public function __construct()
    {
        $this->environment = new Environment;
        $this->setTimeout((int)(config('profitability-exodus-sdk.timeout') ?? self::DEFAULT_TIMEOUT));
    }

    public static function getSessionIdentifier(): ?string
    {
        return auth()->user()?->pharmacy_code;
    }

    public function setTimeout(int $seconds): self
    {
        $this->timeout = $seconds;

        return $this;
    }

    protected function getApiKey(): string
    {
        if ($api_key = Cache::get(self::CACHE_API_KEY_NAME)) {
            return $api_key;
        }

        $api_key = ProfitabilityExodusSDK::authorization()->apiKey();

        Cache::put(self::CACHE_API_KEY_NAME, $api_key, self::CACHE_API_KEY_TTL);

        return $api_key;
    }

    protected function getClientContentType(string $content_type): ?string
    {
        return match ($content_type) {
            self::RESPONSE_IMAGE => 'image/*',
            self::RESPONSE_PDF => 'application/pdf',
            self::RESPONSE_XLSX => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            default => null,
        };
    }

    protected function getRequestHeaders(bool $required_api_key = true): array
    {
        $headers = [];

        if ($required_api_key) {
            $headers['X-API-Key'] = $this->getApiKey();
        }

        return $headers;
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    protected function request(
        string $endpoint,
        string $method = self::METHOD_GET,
        array $data = [],
        string $response_type = self::RESPONSE_JSON,
        bool $required_api_key = true
    ): null|array|PromiseInterface|Response|string|int {
        if (!in_array($response_type, self::RESPONSES_ALLOWED, true)) {
            throw new CustomException(
                error_code: self::BASE_ERROR_CODE_4,
                error_message: self::BASE_ERROR_MESSAGE_4
            );
        }

        if (!in_array($method, self::METHODS_AVAILABLE)) {
            throw new CustomException(
                error_code: self::BASE_ERROR_CODE_2,
                error_message: self::BASE_ERROR_MESSAGE_2
            );
        }

        $client = $this->requestClient($response_type, $required_api_key);

        try {
            if ($method === self::METHOD_GET && empty($data)) {
                $response = $client->get($endpoint);
            } else {
                $response = match ($method) {
                    self::METHOD_DELETE => $client->delete($endpoint, $data),
                    self::METHOD_POST => $client->post($endpoint, $data),
                    self::METHOD_PUT => $client->put($endpoint, $data),
                    self::METHOD_PATCH => $client->patch($endpoint, $data),
                    default => $client->get($endpoint, $data)
                };
            }

            if ($response_type === self::RESPONSE_ASYNC) {
                return $response;
            }

            if ($response_type === self::RESPONSE_NONE && !$response->failed()) {
                return $response;
            }

            if ($response_type === self::RESPONSE_STATUS) {
                return $response->status();
            }

            if ($response->failed()) {
                $response_json = $response->json();

                if ($response->status() === \Symfony\Component\HttpFoundation\Response::HTTP_NOT_ACCEPTABLE) {
                    return $response_json;
                }

                $error_message = 'Exodus error on [' . $method . '] ' . $endpoint;

                if (in_array($response->status(), self::STATUS_WITH_MESSAGE, true)) {
                    $error_response = $response_json;

                    if ($error_response && array_key_exists('message', $error_response)) {
                        $error_message = '[EXODUS] ' . $error_response['message'];
                    }
                }

                if ($response_type === self::RESPONSE_WITH_STATUS && in_array($response->status(), self::STATUSES_NOT_TRANSFORM, true)) {
                    return [$response->json(), $response->status()];
                }

                if ($response->status() === \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR) {
                    Log::error($error_message, $response_json);
                }

                throw new CustomException(
                    error_code: self::BASE_ERROR_CODE_1,
                    error_message: $error_message,
                    http_code: in_array($response->status(), self::STATUSES_NOT_TRANSFORM, true)
                        ? $response->status()
                        : \Symfony\Component\HttpFoundation\Response::HTTP_FAILED_DEPENDENCY
                );
            }

            if ($response->status() === \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT) {
                return null;
            }

            if (in_array($response_type, [self::RESPONSE_IMAGE, self::RESPONSE_PDF, self::RESPONSE_XLSX], true)) {
                return $response->body();
            }

            if ($response_type === self::RESPONSE_WITH_STATUS) {
                return [
                    $response->json(),
                    $response->status(),
                ];
            }

            return $response->json();
        } catch (CustomException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            throw new CustomException(
                error_code: self::BASE_ERROR_CODE_3,
                error_message: $exception->getMessage(),
                http_code: \Symfony\Component\HttpFoundation\Response::HTTP_FAILED_DEPENDENCY
            );
        }
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    protected function requestClient(string $response_type = self::RESPONSE_JSON, bool $required_api_key = true): PendingRequest
    {
        $client = Http::baseUrl($this->environment->baseUrl())->timeout($this->timeout);

        if ($this->environment->get() !== Environment::ENVIRONMENT_PRODUCTION) {
            $client->withoutVerifying();
        }

        if ($response_type === self::RESPONSE_ASYNC) {
            $client->async();
        }

        $content_type = $this->getClientContentType($response_type);

        if ($content_type) {
            $client
                ->accept($content_type)
                ->contentType($content_type);
        }

        if (in_array($response_type, [self::RESPONSE_JSON, self::RESPONSE_ASYNC], true)) {
            $client->acceptJson();
        }

        if ($headers = $this->getRequestHeaders($required_api_key)) {
            $client->withHeaders($headers);
        }

        return $client;
    }
}
