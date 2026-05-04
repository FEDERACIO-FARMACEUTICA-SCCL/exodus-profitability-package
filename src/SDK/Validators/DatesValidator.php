<?php

namespace ProfitabilityExodus\SDK\Validators;

use Illuminate\Support\Carbon;
use Labelgrup\LaravelUtilities\Exceptions\CustomException;
use Symfony\Component\HttpFoundation\Response;

class DatesValidator
{
    public const ERROR_CODE_1 = 'SVC_EXODUS-VDATV-0001';
    public const ERROR_CODE_2 = 'SVC_EXODUS-VDATV-0002';
    public const ERROR_CODE_3 = 'SVC_EXODUS-VDATV-0003';
    public const ERROR_CODE_4 = 'SVC_EXODUS-VDATV-0004';
    public const ERROR_CODE_5 = 'SVC_EXODUS-VDATV-0005';

    public const ERROR_MESSAGE_1 = 'The "from_month" parameter must be in "YYYY-mm" format.';
    public const ERROR_MESSAGE_2 = 'The "to_month" parameter must be in "YYYY-mm" format.';
    public const ERROR_MESSAGE_3 = 'The "from_month" date cannot be later than the "to_month" date.';
    public const ERROR_MESSAGE_4 = 'The year format is invalid. Expected format: YYYY.';
    public const ERROR_MESSAGE_5 = 'The months array must contain integers between 1 and 12.';

    public const FORMAT_YEAR = 'Y';
    public const FORMAT_YEAR_MONTH = 'Y-m';

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function fromMonthAndToMonth(string $from_month, string $to_month): void
    {
        if (!Carbon::hasFormat($from_month, self::FORMAT_YEAR_MONTH)) {
            throw new CustomException(
                error_code: self::ERROR_CODE_1,
                error_message: self::ERROR_MESSAGE_1,
                http_code: Response::HTTP_BAD_REQUEST
            );
        }

        if (!Carbon::hasFormat($to_month, self::FORMAT_YEAR_MONTH)) {
            throw new CustomException(
                error_code: self::ERROR_CODE_2,
                error_message: self::ERROR_MESSAGE_2,
                http_code: Response::HTTP_BAD_REQUEST
            );
        }

        $from = Carbon::createFromFormat(self::FORMAT_YEAR_MONTH, $from_month)->startOfMonth();
        $to = Carbon::createFromFormat(self::FORMAT_YEAR_MONTH, $to_month)->endOfMonth();

        if ($from > $to) {
            throw new CustomException(
                error_code: self::ERROR_CODE_3,
                error_message: self::ERROR_MESSAGE_3,
                http_code: Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public static function yearAndMonths(int $year, array $months): void
    {
        if (!Carbon::hasFormat((string)$year, self::FORMAT_YEAR)) {
            throw new CustomException(
                error_code: self::ERROR_CODE_4,
                error_message: self::ERROR_MESSAGE_4,
                http_code: Response::HTTP_BAD_REQUEST
            );
        }

        foreach ($months as $month) {
            if (!is_int($month) || $month < 1 || $month > 12) {
                throw new CustomException(
                    error_code: self::ERROR_CODE_5,
                    error_message: self::ERROR_MESSAGE_5,
                    http_code: Response::HTTP_BAD_REQUEST
                );
            }
        }
    }
}
