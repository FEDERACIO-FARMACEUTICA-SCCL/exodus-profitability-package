<?php

namespace ProfitabilityExodus\UseCases\DedicationAndPayments;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class PendingDetailUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected string $from_month,
        protected string $to_month,
        protected int $page = BaseExodus::DEFAULT_PAGE,
        protected int $per_page = BaseExodus::DEFAULT_PER_PAGE,
        protected ?string $organization_identifier
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::dedicationsAndPayments()->pending(
            from_month: $this->from_month,
            to_month: $this->to_month,
            page: $this->page,
            per_page: $this->per_page,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
