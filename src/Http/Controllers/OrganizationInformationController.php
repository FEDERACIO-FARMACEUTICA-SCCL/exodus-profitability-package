<?php

namespace ProfitabilityExodus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ProfitabilityExodus\Http\Requests\Organization\InvokeRequest;
use ProfitabilityExodus\UseCases\Organization\GetInformationUseCase;

class OrganizationInformationController extends Controller
{
    public function __invoke(InvokeRequest $request): JsonResponse
    {
        return (new GetInformationUseCase(
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }
}
