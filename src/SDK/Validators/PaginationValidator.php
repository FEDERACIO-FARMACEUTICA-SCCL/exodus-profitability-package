<?php

namespace ProfitabilityExodus\SDK\Validators;

use Labelgrup\LaravelUtilities\Exceptions\CustomException;
use Symfony\Component\HttpFoundation\Response;

class PaginationValidator
{
    public const ERROR_CODE_1 = 'SVC_EXODUS-VPAGV-0001';
    public const ERROR_CODE_2 = 'SVC_EXODUS-VPAGV-0002';

    public const ERROR_MESSAGE_1 = 'The page number must be greater than or equal to 1.';
    public const ERROR_MESSAGE_2 = 'The per page number must be greater than or equal to 1.';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function validate(?int $page, ?int $per_page, bool $nullable = false): void
    {
        if (!self::isValid($page, $nullable)) {
            throw new CustomException(
                error_code: self::ERROR_CODE_1,
                error_message: self::ERROR_MESSAGE_1,
                http_code: Response::HTTP_BAD_REQUEST
            );
        }

        if (!self::isValid($per_page, $nullable)) {
            throw new CustomException(
                error_code: self::ERROR_CODE_2,
                error_message: self::ERROR_MESSAGE_2,
                http_code: Response::HTTP_BAD_REQUEST
            );
        }
    }

    protected static function isValid(?int $value, bool $nullable = false): bool
    {
        if ($nullable && is_null($value)) {
            return true;
        }

        return !is_null($value) && $value >= 1;
    }
}
