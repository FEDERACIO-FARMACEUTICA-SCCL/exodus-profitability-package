<?php

namespace ProfitabilityExodus\Http\Controllers;

use ProfitabilityExodus\Http\Requests\DedicationsAndPayments\IndexRequest;
use ProfitabilityExodus\Http\Requests\DedicationsAndPayments\PendingMarkAsTransferredRequest;
use ProfitabilityExodus\Http\Requests\DedicationsAndPayments\PendingRequest;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\UseCases\DedicationAndPayments\GetUseCase;
use ProfitabilityExodus\UseCases\DedicationAndPayments\PendingDetailUseCase;
use ProfitabilityExodus\UseCases\DedicationAndPayments\PendingMarkAsTransferredUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class DedicationsAndPaymentsController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        return (new GetUseCase(
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function pending(PendingRequest $request): JsonResponse
    {
        return (new PendingDetailUseCase(
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            page: (int) ($request->query('page') ?? BaseExodus::DEFAULT_PAGE),
            per_page: (int) ($request->query('per_page') ?? BaseExodus::DEFAULT_PER_PAGE),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function pendingMarkAsTransferred(PendingMarkAsTransferredRequest $request): JsonResponse
    {
        return (new PendingMarkAsTransferredUseCase(
            organization_identifier: $request->input('organization_identifier')
        ))->handle()->responseToApi(true);
    }
}
