<?php

namespace ProfitabilityExodus\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ProfitabilityExodus\Http\Requests\Reports\DiscountsRequest;
use ProfitabilityExodus\Http\Requests\Reports\FiltersRequest;
use ProfitabilityExodus\Http\Requests\Reports\FreeSalesRequest;
use ProfitabilityExodus\Http\Requests\Reports\GenericsRequest;
use ProfitabilityExodus\Http\Requests\Reports\MarginsRequest;
use ProfitabilityExodus\SDK\Core\BaseExodus;
use ProfitabilityExodus\SDK\Enums\Report\FreeSale\ClassificationType;
use ProfitabilityExodus\SDK\Enums\Report\Type;
use ProfitabilityExodus\UseCases\Reports\ExportDiscountsUseCase;
use ProfitabilityExodus\UseCases\Reports\ExportFreeSalesUseCase;
use ProfitabilityExodus\UseCases\Reports\ExportGenericsUseCase;
use ProfitabilityExodus\UseCases\Reports\ExportMarginsUseCase;
use ProfitabilityExodus\UseCases\Reports\GetDiscountsUseCase;
use ProfitabilityExodus\UseCases\Reports\GetFiltersUseCase;
use ProfitabilityExodus\UseCases\Reports\GetFreeSalesUseCase;
use ProfitabilityExodus\UseCases\Reports\GetGenericsUseCase;
use ProfitabilityExodus\UseCases\Reports\GetMarginsUseCase;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportsController extends Controller
{
    public function discounts(DiscountsRequest $request): JsonResponse
    {
        return (new GetDiscountsUseCase(
            year: (int)$request->query('year'),
            months: array_map(static fn (int|string $month) => (int)$month, $request->query('months')),
            laboratory: $request->query('laboratory'),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function discountsExport(DiscountsRequest $request): StreamedResponse
    {
        return (new ExportDiscountsUseCase(
            year: (int)$request->query('year'),
            months: array_map(static fn (int|string $month) => (int)$month, $request->query('months')),
            laboratory: $request->query('laboratory'),
            organization_identifier: $request->query('organization_identifier')
        ))->downloadExcel();
    }

    public function filters(string $report_type, FiltersRequest $request): JsonResponse
    {
        return (new GetFiltersUseCase(
            report_type: Type::fromRoute($report_type),
            page: (int) ($request->query('page') ?? BaseExodus::DEFAULT_PAGE),
            per_page: (int) ($request->query('per_page') ?? BaseExodus::DEFAULT_PER_PAGE),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function freeSales(FreeSalesRequest $request): JsonResponse
    {
        return (new GetFreeSalesUseCase(
            year: (int)$request->query('year'),
            months: array_map(static fn (int|string $month) => (int)$month, $request->query('months')),
            classification_type: ClassificationType::from($request->input('classification_type') ?? ClassificationType::ALL->value),
            laboratory: $request->query('laboratory'),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function freeSalesExport(FreeSalesRequest $request): StreamedResponse
    {
        return (new ExportFreeSalesUseCase(
            year: (int)$request->query('year'),
            months: array_map(static fn (int|string $month) => (int)$month, $request->query('months')),
            classification_type: ClassificationType::from($request->input('classification_type') ?? ClassificationType::ALL->value),
            laboratory: $request->query('laboratory'),
            organization_identifier: $request->query('organization_identifier')
        ))->downloadExcel();
    }

    public function generics(GenericsRequest $request): JsonResponse
    {
        return (new GetGenericsUseCase(
            year: (int)$request->query('year'),
            months: array_map(static fn (int|string $month) => (int)$month, $request->query('months')),
            laboratory: $request->query('laboratory'),
            filter_only_club: $this->parseBoolQueryParams(value: $request->query('filter_only_club'), default: false),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function genericsExport(GenericsRequest $request): StreamedResponse
    {
        return (new ExportGenericsUseCase(
            year: (int)$request->query('year'),
            months: array_map(static fn (int|string $month) => (int)$month, $request->query('months')),
            laboratory: $request->query('laboratory'),
            filter_only_club: $request->boolean('filter_only_club') ?? false,
            organization_identifier: $request->query('organization_identifier')
        ))->downloadExcel();
    }

    public function margins(MarginsRequest $request): JsonResponse
    {
        return (new GetMarginsUseCase(
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            laboratory: $request->query('laboratory'),
            organization_identifier: $request->query('organization_identifier')
        ))->handle()->responseToApi(true);
    }

    public function marginsExport(MarginsRequest $request): StreamedResponse
    {
        return (new ExportMarginsUseCase(
            from_month: $request->query('from_month'),
            to_month: $request->query('to_month'),
            laboratory: $request->query('laboratory'),
            organization_identifier: $request->query('organization_identifier')
        ))->downloadExcel();
    }
}
