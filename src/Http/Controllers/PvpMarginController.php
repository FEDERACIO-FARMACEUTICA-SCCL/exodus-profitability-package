<?php

namespace ProfitabilityExodus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ProfitabilityExodus\Http\Requests\PvpRequest;
use ProfitabilityExodus\UseCases\PvpMargin\GetUseCase;

class PvpMarginController extends Controller
{
    public function __invoke(PvpRequest $request): JsonResponse
    {
        return (new GetUseCase(
            from_month: $request->input('from_month'),
            to_month: $request->input('to_month'),
            organization_identifier: $request->input('organization_identifier')
        ))->handle()->responseToApi(true);
    }
}
