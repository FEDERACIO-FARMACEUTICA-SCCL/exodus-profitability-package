<?php

namespace ProfitabilityExodus\UseCases;

use ProfitabilityExodus\SDK\Core\BaseExodus;

trait OrganizationIdentifierTrait
{
    protected function getOrganizationIdentifier(): ?string
    {
        return $this->organization_identifier ?? BaseExodus::getSessionIdentifier();
    }
}
