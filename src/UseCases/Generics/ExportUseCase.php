<?php

namespace ProfitabilityExodus\UseCases\Generics;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\DownloadExcelTrait;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ExportUseCase extends UseCase
{
    use DownloadExcelTrait, OrganizationIdentifierTrait;

    public const EXPORT_FILENAME = 'generics.xlsx';

    public function __construct(
        protected string $from_month,
        protected string $to_month,
        protected ?string $search_query = null,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): string
    {
        return ProfitabilityExodusSDK::generics()->export(
            from_month: $this->from_month,
            to_month: $this->to_month,
            search_query: $this->search_query,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
