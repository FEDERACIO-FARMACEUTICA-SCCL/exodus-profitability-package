<?php

namespace ProfitabilityExodus\UseCases\DedicationAndPayments;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class PendingMarkAsTransferredUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected ?string $organization_identifier
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::dedicationsAndPayments()->pendingMarkAsTransferred(
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
