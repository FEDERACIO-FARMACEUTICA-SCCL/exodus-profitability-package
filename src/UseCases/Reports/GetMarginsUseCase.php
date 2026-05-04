<?php

namespace ProfitabilityExodus\UseCases\Reports;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class GetMarginsUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected string $from_month,
        protected string $to_month,
        protected ?string $laboratory = null,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        if (!$this->laboratory) {
            return ProfitabilityExodusSDK::reports()->marginsSummary(
                from_month: $this->from_month,
                to_month: $this->to_month,
                organization_identifier: $this->getOrganizationIdentifier()
            );
        }

        return ProfitabilityExodusSDK::reports()->margins(
            from_month: $this->from_month,
            to_month: $this->to_month,
            laboratory: $this->laboratory,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
