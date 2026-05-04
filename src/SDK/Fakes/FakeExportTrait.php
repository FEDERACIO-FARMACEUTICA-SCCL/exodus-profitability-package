<?php

namespace ProfitabilityExodus\SDK\Fakes;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;

trait FakeExportTrait
{
    protected static function responseExport(string $file): PromiseInterface
    {
        $path = dirname(__DIR__, 2);

        return Http::response(
            body: file_get_contents("$path/$file"),
            headers: [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="report.xlsx"',
            ]
        );
    }
}
