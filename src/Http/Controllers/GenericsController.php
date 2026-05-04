<?php

namespace ProfitabilityExodus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ProfitabilityExodus\Http\Requests\Generics\DetailRequest;
use ProfitabilityExodus\SDK\Enums\Generic\Type;
use ProfitabilityExodus\UseCases\Generics\DetailUseCase;

class GenericsController extends Controller
{
    public function __invoke(string $type, DetailRequest $request): JsonResponse
    {
        return (new DetailUseCase(
            type: Type::fromRoute($type),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }
}
