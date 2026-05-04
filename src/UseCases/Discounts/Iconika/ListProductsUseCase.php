<?php

namespace ProfitabilityExodus\UseCases\Discounts\Iconika;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Enums\FreeSale\Type;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ListProductsUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected Type $type,
        protected ?string $from_month,
        protected ?string $to_month,
        protected ?string $search_query = null,
        protected ?int $page = null,
        protected ?int $per_page = null,
        protected ?string $organization_identifier = null
    ) {
        if (!$this->page) {
            $this->page = BaseExodus::DEFAULT_PAGE;
        }

        if (!$this->per_page) {
            $this->per_page = BaseExodus::DEFAULT_PER_PAGE;
        }
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::discounts()->iconika()->listProducts(
            type: $this->type,
            from_month: $this->from_month,
            to_month: $this->to_month,
            search_query: $this->search_query,
            page: $this->page,
            per_page: $this->per_page,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
