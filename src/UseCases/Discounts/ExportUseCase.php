<?php

namespace ProfitabilityExodus\UseCases\Discounts;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\Enums\FreeSale\Type;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\DownloadExcelTrait;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ExportUseCase extends UseCase
{
    use DownloadExcelTrait, OrganizationIdentifierTrait;

    public const EXPORT_FILENAME = 'discounts_export.xlsx';

    public function __construct(
        protected Type $type,
        protected ?string $search_query = null,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): string
    {
        return ProfitabilityExodusSDK::discounts()->export(
            type: $this->type,
            search_query: $this->search_query,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
