<?php

namespace ProfitabilityExodus;

use Illuminate\Support\Facades\Route;
use ProfitabilityExodus\Http\Controllers\DedicationsAndPaymentsController;
use ProfitabilityExodus\Http\Controllers\DiscountsController;
use ProfitabilityExodus\Http\Controllers\DiscountsFreeSalesController;
use ProfitabilityExodus\Http\Controllers\GenericsController;
use ProfitabilityExodus\Http\Controllers\OrganizationInformationController;
use ProfitabilityExodus\Http\Controllers\OtcDetailController;
use ProfitabilityExodus\Http\Controllers\PvpMarginController;
use ProfitabilityExodus\Http\Controllers\ReportsController;

class ProfitabilityExodusRouter
{
    public static function routes(string $prefix = 'profitability', array $middlewares = []): void
    {
        Route::prefix($prefix)->middleware($middlewares)->group(function () {
            Route::get('organization-information', OrganizationInformationController::class)->name('organization_information');
            Route::get('dedications-and-payments', [DedicationsAndPaymentsController::class, 'index'])->name('dedications_and_payments');
            Route::get('dedications-and-payments/pending', [DedicationsAndPaymentsController::class, 'pending'])->name('dedications_and_payments.pending');
            Route::patch('dedications-and-payments/pending/mark-transferred', [DedicationsAndPaymentsController::class, 'pendingMarkAsTransferred'])->name('dedications_and_payments.pending_mark_as_transferred');

            Route::prefix('discounts')->name('discounts.')->group(function () {
                Route::get('/', [DiscountsController::class, 'index'])->name('index');
                Route::get('detail', [DiscountsController::class, 'detail'])->name('detail');
                Route::get('generics', [DiscountsController::class, 'generics'])->name('generics');
                Route::get('generics/export', [DiscountsController::class, 'genericsExport'])->name('generics.export');
                Route::prefix('free-sales/{type}')->name('free_sales.')->group(function () {
                    Route::get('/', [DiscountsFreeSalesController::class, 'index'])->name('index');
                    Route::get('export', [DiscountsFreeSalesController::class, 'export'])->name('export');
                    Route::prefix('iconika')->name('iconika.')->group(function () {
                        Route::get('categories', [DiscountsFreeSalesController::class, 'iconikaCategories'])->name('categories');
                        Route::get('laboratories', [DiscountsFreeSalesController::class, 'iconikaLaboratories'])->name('laboratories');
                        Route::get('laboratories/export', [DiscountsFreeSalesController::class, 'iconikaLaboratoriesExport'])->name('laboratories.export');
                        Route::get('products', [DiscountsFreeSalesController::class, 'iconikaProducts'])->name('products');
                        Route::get('products/export', [DiscountsFreeSalesController::class, 'iconikaProductsExport'])->name('products.export');
                    });
                });
                Route::get('free-sales/parapharmacy/iconika/filters', [DiscountsFreeSalesController::class, 'iconikaParpharmacyFilters'])->name('free_sales.iconika.parapharmacy.filters');
            });

            Route::get('generics/{type}', GenericsController::class)->name('generics');

            Route::get('pvp-margin', PvpMarginController::class)->name('pvp_margin');
            Route::get('otc-detail', OtcDetailController::class)->name('otc_detail');

            Route::prefix('reports')->name('reports.')->group(function () {
                Route::get('discounts', [ReportsController::class, 'discounts'])->name('discounts.index');
                Route::get('discounts/export', [ReportsController::class, 'discountsExport'])->name('discounts.export');
                Route::get('filters/{report_type}', [ReportsController::class, 'filters'])->name('filters');
                Route::get('free-sales', [ReportsController::class, 'freeSales'])->name('free_sales.index');
                Route::get('free-sales/export', [ReportsController::class, 'freeSalesExport'])->name('free_sales.export');
                Route::get('generics', [ReportsController::class, 'generics'])->name('generics.index');
                Route::get('generics/export', [ReportsController::class, 'genericsExport'])->name('generics.export');
                Route::get('margins', [ReportsController::class, 'margins'])->name('margins.index');
                Route::get('margins/export', [ReportsController::class, 'marginsExport'])->name('margins.export');
            });
        });
    }
}
