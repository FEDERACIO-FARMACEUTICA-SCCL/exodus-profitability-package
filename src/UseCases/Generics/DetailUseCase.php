<?php

namespace ProfitabilityExodus\UseCases\Generics;

use Labelgrup\LaravelUtilities\Core\UseCases\UseCase;
use ProfitabilityExodus\SDK\Enums\Generic\Type;
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;
use ProfitabilityExodus\UseCases\OrganizationIdentifierTrait;

class DetailUseCase extends UseCase
{
    use OrganizationIdentifierTrait;

    public function __construct(
        protected Type $type,
        protected ?string $organization_identifier = null
    ) {
    }

    /**
     * @throws \Labelgrup\LaravelUtilities\Exceptions\CustomException
     */
    public function action(): array
    {
        return ProfitabilityExodusSDK::generics()->detail(
            type: $this->type,
            organization_identifier: $this->getOrganizationIdentifier()
        );
    }
}
