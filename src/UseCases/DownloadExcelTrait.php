<?php

namespace ProfitabilityExodus\UseCases;

use Symfony\Component\HttpFoundation\StreamedResponse;

trait DownloadExcelTrait
{
    public function downloadExcel(): StreamedResponse
    {
        $export = $this->perform();

        return response()->streamDownload(
            function () use ($export) {
                echo $export;
            },
            self::EXPORT_FILENAME,
            ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
        );
    }
}
