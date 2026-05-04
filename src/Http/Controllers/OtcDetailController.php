<?php

namespace ProfitabilityExodus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ProfitabilityExodus\Http\Requests\OtcRequest;
use ProfitabilityExodus\UseCases\OtcDetail\GetUseCase;

class OtcDetailController extends Controller
{
    public function __invoke(OtcRequest $request): JsonResponse
    {
        return (new GetUseCase(
            otc_type: $request->input('otc_type'),
            organization_identifier: $request->input('organization_identifier')
        ))->handle()->responseToApi(true);
    }
}
