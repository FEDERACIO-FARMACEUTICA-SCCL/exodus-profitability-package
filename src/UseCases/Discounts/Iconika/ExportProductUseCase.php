<?php

namespace ProfitabilityExodus\UseCases\Discounts\Iconika;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\Enums\FreeSale\Type;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\DownloadExcelTrait;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ExportProductUseCase extends UseCase
{
    use DownloadExcelTrait, OrganizationIdentifierTrait;

    public const EXPORT_FILENAME = 'advertising_iconika_products_export.xlsx';

    public function __construct(
        protected Type $type,
        protected ?string $from_month,
        protected ?string $to_month,
        protected ?string $search_query = null,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): string
    {
        return ProfitabilityExodusSDK::discounts()->iconika()->exportProducts(
            type: $this->type,
            from_month: $this->from_month,
            to_month: $this->to_month,
            search_query: $this->search_query,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
