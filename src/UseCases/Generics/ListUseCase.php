<?php

namespace ProfitabilityExodus\UseCases\Generics;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class ListUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected string $from_month,
        protected string $to_month,
        protected ?string $search_query = null,
        protected ?int $page = null,
        protected ?int $per_page = null,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::generics()->list(
            from_month: $this->from_month,
            to_month: $this->to_month,
            search_query: $this->search_query,
            page: $this->page,
            per_page: $this->per_page,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
