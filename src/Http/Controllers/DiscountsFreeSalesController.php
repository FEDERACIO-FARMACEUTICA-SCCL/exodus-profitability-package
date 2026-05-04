<?php

namespace ProfitabilityExodus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ProfitabilityExodus\Http\Requests\DiscountsFreeSales\CategoriesRequest;
use ProfitabilityExodus\Http\Requests\DiscountsFreeSales\IndexRequest;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Enums\FreeSale\Type;
use ProfitabilityExodus\UseCases\Discounts\ExportUseCase;
use ProfitabilityExodus\UseCases\Discounts\Iconika\ExportLaboratoriesUseCase;
use ProfitabilityExodus\UseCases\Discounts\Iconika\ExportProductUseCase;
use ProfitabilityExodus\UseCases\Discounts\Iconika\GetCategoriesUseCase;
use ProfitabilityExodus\UseCases\Discounts\Iconika\ListLaboratoriesUseCase;
use ProfitabilityExodus\UseCases\Discounts\Iconika\ListProductsUseCase;
use ProfitabilityExodus\UseCases\Discounts\ListUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DiscountsFreeSalesController extends Controller
{
    public function index(string $type, IndexRequest $request): JsonResponse
    {
        return (new ListUseCase(
            type: Type::fromRoute($type),
            search_query: $request->query('search_query'),
            page: (int) ($request->query('page') ?? BaseExodus::DEFAULT_PAGE),
            per_page: (int) ($request->query('per_page') ?? BaseExodus::DEFAULT_PER_PAGE),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function export(string $type, IndexRequest $request): StreamedResponse
    {
        $this->setAuthLocale();

        return (new ExportUseCase(
            type: Type::fromRoute($type),
            search_query: $request->query('search_query'),
            organization_identifier: $request->query('organization_identifier')
        ))->downloadExcel();
    }

    public function iconikaCategories(string $type, CategoriesRequest $request): JsonResponse
    {
        abort_if(Type::fromRoute($type) !== Type::PARAPHARMACY, Response::HTTP_NOT_FOUND, 'Filters are only available for parapharmacy type.');

        return (new GetCategoriesUseCase(
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function iconikaLaboratories(string $type, IndexRequest $request): JsonResponse
    {
        return (new ListLaboratoriesUseCase(
            type: Type::fromRoute($type),
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            search_query: $request->query('search_query'),
            page: (int) ($request->query('page') ?? BaseExodus::DEFAULT_PAGE),
            per_page: (int) ($request->query('per_page') ?? BaseExodus::DEFAULT_PER_PAGE),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function iconikaLaboratoriesExport(string $type, IndexRequest $request): StreamedResponse
    {
        $this->setAuthLocale();

        return (new ExportLaboratoriesUseCase(
            type: Type::fromRoute($type),
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            search_query: $request->query('search_query'),
            organization_identifier: $request->query('organization_identifier')
        ))->downloadExcel();
    }

    public function iconikaProducts(string $type, IndexRequest $request): JsonResponse
    {
        return (new ListProductsUseCase(
            type: Type::fromRoute($type),
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            search_query: $request->query('search_query'),
            page: (int) ($request->query('page') ?? BaseExodus::DEFAULT_PAGE),
            per_page: (int) ($request->query('per_page') ?? BaseExodus::DEFAULT_PER_PAGE),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function iconikaProductsExport(string $type, IndexRequest $request): StreamedResponse
    {
        $this->setAuthLocale();

        return (new ExportProductUseCase(
            type: Type::fromRoute($type),
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            search_query: $request->query('search_query'),
            organization_identifier: $request->query('organization_identifier')
        ))->downloadExcel();
    }
}
