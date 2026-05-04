<?php

namespace ProfitabilityExodus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ProfitabilityExodus\Http\Requests\Discounts\GenericsRequest;
use ProfitabilityExodus\Http\Requests\Discounts\IndexRequest;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\UseCases\Discounts\DetailUseCase;
use ProfitabilityExodus\UseCases\Discounts\GetUseCase;
use ProfitabilityExodus\UseCases\Generics\ExportUseCase;
use ProfitabilityExodus\UseCases\Generics\ListUseCase;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DiscountsController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        return (new GetUseCase(
            from_month: $request->input('from_month'),
            to_month: $request->input('to_month'),
            organization_identifier: $request->input('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function detail(IndexRequest $request): JsonResponse
    {
        return (new DetailUseCase(
            from_month: $request->input('from_month'),
            to_month: $request->input('to_month'),
            organization_identifier: $request->input('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function generics(GenericsRequest $request): JsonResponse
    {
        return (new ListUseCase(
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            search_query: $request->query('search_query'),
            page: (int) ($request->query('page') ?? BaseExodus::DEFAULT_PAGE),
            per_page: (int) ($request->query('per_page') ?? BaseExodus::DEFAULT_PER_PAGE),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function genericsExport(GenericsRequest $request): StreamedResponse
    {
        $this->setAuthLocale();

        return (new ExportUseCase(
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            search_query: $request->query('search_query'),
            organization_identifier: $request->query('organization_identifier')
        ))->downloadExcel();
    }
}
