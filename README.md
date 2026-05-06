# Exodus Profitability

Exodus Profitability SDK is a Laravel package that provides a simple way to interact with the Exodus Profitability API from Fedefarma.

## 📦 Installation

1. Use the package manager [composer](https://getcomposer.org/) to install Exodus Profitability SDK. Add in your **composer.json** the repository.
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:labelgrupnetworks/exodus-profitability-package.git"
    }
  ]
}
```

2. Install the package.
```bash
composer require fedefarma/exodus-profitability-package
```

3. Publish the configuration file.
```bash
php artisan vendor:publish --tag="profitability-exodus-sdk"
```

4. Add the following environment variables to your `.env` file.

```bash
PROFITABILITY_EXODUS_ENVIRONMENT=development  # 'development' or 'production'
PROFITABILITY_EXODUS_API_KEY=XXXXX
PROFITABILITY_EXODUS_USER=XXXXX
PROFITABILITY_EXODUS_PASSWORD=XXXXX

# Optional: force a custom base URL (useful for local proxies or tunnels)
# PROFITABILITY_EXODUS_FORCE_BASE_URL=https://my-custom-url.test/profitability/api
```

## ⚙️ Configuration

The config file is published at `config/profitability-exodus-sdk.php`:

```php
return [
    'environment' => env('PROFITABILITY_EXODUS_ENVIRONMENT', 'production'),
    'api_key' => env('PROFITABILITY_EXODUS_API_KEY'),
    'force_base_url' => env('PROFITABILITY_EXODUS_FORCE_BASE_URL'),
    'user_language_column' => 'language',
    'timeout' => 120,
];
```

| Key | Type | Default | Description |
|-----|------|---------|-------------|
| `environment` | `string` | `'production'` | API environment: `'development'` or `'production'` |
| `api_key` | `string` | `null` | Exodus API key used in `X-API-Key` header |
| `credentials.user` | `string` | `null` | API username |
| `credentials.password` | `string` | `null` | API password |
| `force_base_url` | `string\|null` | `null` | Override the base URL for all requests |
| `user_language_column` | `string` | `'language'` | User model attribute used to send language in exports |
| `timeout` | `int` | `120` | HTTP request timeout in seconds |

## 🚀 Usage

```php
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;

// Get organization information
$info = ProfitabilityExodusSDK::organization()->information();

// Get PVP margin data
$margins = ProfitabilityExodusSDK::pvpMargin()->get('2025-01', '2025-06');

// Get a profitability report
$report = ProfitabilityExodusSDK::reports()->margins('2025-01', '2025-06');
```

## 📚 Resources

### `authorization()`

Handles API key retrieval. The key is automatically cached for 1 hour.

```php
public function apiKey(): string
```

---

### `organization()`

Resource to retrieve organization information.

```php
/**
 * Get organization information.
 *
 * @param string|null $organization_identifier
 * @return array
 */
public function information(?string $organization_identifier = null): array
```

---

### `dedicationsAndPayments()`

Resource to interact with dedications and payments.

```php
/**
 * Get dedications and payments summary.
 *
 * @param string $from_month  Format: YYYY-mm
 * @param string $to_month    Format: YYYY-mm
 * @param string|null $organization_identifier
 * @return array
 */
public function get(string $from_month, string $to_month, ?string $organization_identifier = null): array

/**
 * Get pending transfers with pagination.
 *
 * @param string $from_month  Format: YYYY-mm
 * @param string $to_month    Format: YYYY-mm
 * @param int $page           Default: 1
 * @param int $per_page       Default: 10
 * @param string|null $organization_identifier
 * @return array
 */
public function pending(string $from_month, string $to_month, int $page = 1, int $per_page = 10, ?string $organization_identifier = null): array

/**
 * Mark pending transfers as transferred.
 *
 * @param string|null $organization_identifier
 * @return array
 */
public function pendingMarkAsTransferred(?string $organization_identifier = null): array
```

---

### `discounts()`

Resource to interact with discounts data (OTC / free sales).

```php
/**
 * Get discounts headers detail.
 *
 * @param string $from_month  Format: YYYY-mm
 * @param string $to_month    Format: YYYY-mm
 * @param string|null $organization_identifier
 * @return array
 */
public function detail(string $from_month, string $to_month, ?string $organization_identifier = null): array

/**
 * Export OTC list as XLSX.
 *
 * @param \ProfitabilityExodusSDK\SDK\Enums\FreeSale\Type $type
 * @param string|null $search_query
 * @param string|null $organization_identifier
 * @return string  Raw XLSX binary content
 */
public function export(Type $type, ?string $search_query = null, ?string $organization_identifier = null): string

/**
 * Get company discounts summary.
 *
 * @param string $from_month  Format: YYYY-mm
 * @param string $to_month    Format: YYYY-mm
 * @param string|null $organization_identifier
 * @return array
 */
public function get(string $from_month, string $to_month, ?string $organization_identifier = null): array

/**
 * Get OTC / free sale product list (paginated).
 *
 * @param \ProfitabilityExodusSDK\SDK\Enums\FreeSale\Type $type
 * @param string|null $search_query
 * @param int|null $page
 * @param int|null $per_page
 * @param string|null $organization_identifier
 * @return array
 */
public function list(Type $type, ?string $search_query = null, ?int $page = null, ?int $per_page = null, ?string $organization_identifier = null): array

/**
 * Access Iconika discounts sub-resource.
 *
 * @return \ProfitabilityExodusSDK\SDK\Resources\DiscountsIconikaExodus
 */
public function iconika(): DiscountsIconikaExodus
```

#### `discounts()->iconika()`

```php
public function categories(string $from_month, string $to_month, ?string $organization_identifier = null): array
public function exportLaboratories(Type $type, string $from_month, string $to_month, ?string $search_query = null, ?string $organization_identifier = null): string
public function exportProducts(Type $type, string $from_month, string $to_month, ?string $search_query = null, ?string $organization_identifier = null): string
public function listLaboratories(Type $type, string $from_month, string $to_month, ?string $search_query = null, ?int $page = null, ?int $per_page = null, ?string $organization_identifier = null): array
public function listProducts(Type $type, string $from_month, string $to_month, ?string $search_query = null, ?int $page = null, ?int $per_page = null, ?string $organization_identifier = null): array
```

---

### `generics()`

Resource to interact with generics data.

```php
/**
 * Get generics detail by type.
 *
 * @param \ProfitabilityExodusSDK\SDK\Enums\Generic\Type $type
 * @param string|null $organization_identifier
 * @return array
 */
public function detail(Type $type, ?string $organization_identifier = null): array

/**
 * Export generics list as XLSX.
 *
 * @param string $from_month  Format: YYYY-mm
 * @param string $to_month    Format: YYYY-mm
 * @param string|null $search_query
 * @param string|null $organization_identifier
 * @return string  Raw XLSX binary content
 */
public function export(string $from_month, string $to_month, ?string $search_query = null, ?string $organization_identifier = null): string

/**
 * Get generics list (paginated).
 *
 * @param string $from_month  Format: YYYY-mm
 * @param string $to_month    Format: YYYY-mm
 * @param string|null $search_query
 * @param int|null $page
 * @param int|null $per_page
 * @param string|null $organization_identifier
 * @return array
 */
public function list(string $from_month, string $to_month, ?string $search_query = null, ?int $page = null, ?int $per_page = null, ?string $organization_identifier = null): array
```

---

### `pvpMargin()`

Resource to interact with PVP margin data.

```php
/**
 * Get PVP margin summary.
 *
 * @param string $from_month  Format: YYYY-mm
 * @param string $to_month    Format: YYYY-mm
 * @param string|null $organization_identifier
 * @return array
 */
public function get(string $from_month, string $to_month, ?string $organization_identifier = null): array
```

---

### `otcDetail()`

Resource to interact with OTC detail data.

```php
/**
 * Get OTC margin detail.
 *
 * @param string|null $organization_identifier
 * @param string $otc_type
 * @return array
 */
public function get(?string $organization_identifier = null, string $otc_type): array
```

---

### `reports()`

Resource to interact with profitability reports. All export methods return raw XLSX binary content.

```php
// Discounts report
public function discounts(int $year, array $months, ?string $laboratory = null, ?string $organization_identifier = null): array
public function discountsExport(int $year, array $months, ?string $laboratory = null, ?string $organization_identifier = null): string
public function discountsSummary(int $year, array $months, ?string $organization_identifier = null): array
public function discountsSummaryExport(int $year, array $months, ?string $organization_identifier = null): string

// Filters
public function filters(Type $report_type, int $page, int $per_page, ?string $organization_identifier = null): array

// Free sales (OTC) report
public function freeSales(int $year, array $months, ClassificationType $classification_type = ClassificationType::ALL, ?string $laboratory = null, ?string $organization_identifier = null): array
public function freeSalesExport(int $year, array $months, ClassificationType $classification_type = ClassificationType::ALL, ?string $laboratory = null, ?string $organization_identifier = null): string
public function freeSalesSummary(int $year, array $months, ClassificationType $classification_type = ClassificationType::ALL, ?string $organization_identifier = null): array
public function freeSalesSummaryExport(int $year, array $months, ClassificationType $classification_type = ClassificationType::ALL, ?string $organization_identifier = null): string

// Generics report
public function generics(int $year, array $months, ?string $laboratory = null, bool $filter_only_club = false, ?string $organization_identifier = null): array
public function genericsExport(int $year, array $months, ?string $laboratory = null, bool $filter_only_club = false, ?string $organization_identifier = null): string
public function genericsSummary(int $year, array $months, bool $filter_only_club = false, ?string $organization_identifier = null): array
public function genericsSummaryExport(int $year, array $months, bool $filter_only_club = false, ?string $organization_identifier = null): string

// Margins report
public function margins(string $from_month, string $to_month, ?string $laboratory = null, ?string $organization_identifier = null): array
public function marginsExport(string $from_month, string $to_month, ?string $laboratory = null, ?string $organization_identifier = null): string
public function marginsSummary(string $from_month, string $to_month, ?string $organization_identifier = null): array
public function marginsSummaryExport(string $from_month, string $to_month, ?string $organization_identifier = null): string
```

---

## 🧩 Enums

### `FreeSale\Type`

Used in `discounts()` and `discounts()->iconika()` resources.

| Case | Value |
|------|-------|
| `PARAPHARMACY` | `'PARAPHARMACY'` |
| `PROMOTIONAL` | `'PROMOTIONAL'` |

```php
use ProfitabilityExodus\SDK\Enums\FreeSale\Type;

// From a route parameter (e.g. 'parapharmacy' or 'promotional')
$type = Type::fromRoute('parapharmacy');
```

### `Generic\Type`

Used in `generics()` resource.

| Case | Value |
|------|-------|
| `ACOFARMA` | `'ACOFARMA'` |
| `CONCENTRATION` | `'CONCENTRATION'` |
| `GENERIFICATION` | `'GENERIFICATION'` |

```php
use ProfitabilityExodus\SDK\Enums\Generic\Type;

$type = Type::fromRoute('generification');
```

### `Report\Type`

Used in `reports()->filters()`.

| Case | Value |
|------|-------|
| `DISCOUNTS` | `'DISCOUNTS'` |
| `FREE_SALES` | `'FREE_SALES'` |
| `GENERICS` | `'GENERICS'` |
| `MARGINS` | `'MARGINS'` |

```php
use ProfitabilityExodus\SDK\Enums\Report\Type;

$type = Type::fromRoute('margins');
$allowedValues = Type::allowedValues(); // ['DISCOUNTS', 'FREE_SALES', 'GENERICS', 'MARGINS']
```

### `Report\FreeSale\ClassificationType`

Used in free sales report methods.

| Case | Value | Exodus value |
|------|-------|-------------|
| `ALL` | `'ALL'` | `null` (no filter) |
| `PARAPHARMACY` | `'PARAPHARMACY'` | `'PARAPHARMACY'` |
| `PROMOTIONAL` | `'PROMOTIONAL'` | `'PROMOTIONAL'` |

---

## ⚠️ Error Codes

### Core (`BaseExodus`)

| Code | Description |
|------|-------------|
| `SVC_EXODUS-CORE-0001` | HTTP request failed |
| `SVC_EXODUS-CORE-0002` | Invalid HTTP method |
| `SVC_EXODUS-CORE-0003` | Unexpected exception during request |
| `SVC_EXODUS-CORE-0004` | Response type not supported |

### Environment

| Code | Description |
|------|-------------|
| `SVC_EXODUS-ENV-0001` | Invalid environment (not `development` or `production`) |

### Date Validator

| Code | Description |
|------|-------------|
| `SVC_EXODUS-VDATV-0001` | `from_month` must be in `YYYY-mm` format |
| `SVC_EXODUS-VDATV-0002` | `to_month` must be in `YYYY-mm` format |
| `SVC_EXODUS-VDATV-0003` | `from_month` cannot be later than `to_month` |
| `SVC_EXODUS-VDATV-0004` | Year must be in `YYYY` format |
| `SVC_EXODUS-VDATV-0005` | Months array must contain integers between 1 and 12 |

### Pagination Validator

| Code | Description |
|------|-------------|
| `SVC_EXODUS-VPAGV-0001` | Page number must be ≥ 1 |
| `SVC_EXODUS-VPAGV-0002` | Per-page number must be ≥ 1 |

---

## 🌐 Environments

| Environment | Base URL |
|-------------|----------|
| `development` | `https://exodus.fedefarma.dev/profitability/api` |
| `production` | `http://exodus.fedefarma.com/profitability/api` |

> [!NOTE]
> SSL verification is disabled automatically in non-production environments.

---

## 📖 Swagger / OpenAPI

The package integrates with [l5-swagger](https://github.com/DarkaOnLine/L5-Swagger) for multi-documentation support. The spec is a static multi-file OpenAPI 3.0 structure — no annotation scanning, no code generation.

On boot, the service provider copies the entire `swagger/` directory to `public/api-docs/exodus/`. The files in `public/` are served directly by the web server, which allows Swagger UI to resolve `$ref` links to individual path files.

The config returned by `ProfitabilityExodusSwagger::config()` forces `generate_always => false`, so l5-swagger will never attempt to scan and regenerate this documentation.

### Setup

1. Register the documentation in your `config/l5-swagger.php`:

```php
'documentations' => [
    // ... other docs
    'exodus' => \ProfitabilityExodus\ProfitabilityExodusSwagger::config(
        servers: [
            ['url' => env('APP_URL') . '/api/v2', 'description' => 'API Server'],
        ]
    ),
],
```

2. The `url` in `servers` must match the prefix you use when registering routes. If your project uses a different prefix, update both:

```php
// routes/api.php
ProfitabilityExodusRouter::routes(prefix: 'profitability', middlewares: ['auth:sanctum']);

// config/l5-swagger.php
'exodus' => \ProfitabilityExodus\ProfitabilityExodusSwagger::config(
    servers: [
        ['url' => env('APP_URL') . '/api/profitability', 'description' => 'API Server'],
    ]
),
```

3. The Swagger UI will be available at `api/exodus/documentation` by default. You can change the route:

```php
\ProfitabilityExodus\ProfitabilityExodusSwagger::config(
    route: 'api/my-custom/documentation',
    servers: [...]
)
```

> **If your project also has its own l5-swagger documentation**, always generate it by name to avoid unintended side effects:
> ```bash
> # Correct — only regenerates your documentation
> php artisan l5-swagger:generate your-doc-name
>
> # Wrong — triggers all documentations
> php artisan l5-swagger:generate
> ```

### Spec structure (package contributors only)

The spec is a multi-file OpenAPI structure. `api-docs.json` is the root file — it contains the metadata, components, and `$ref` links to individual path files. There is no build step.

```
swagger/
├── api-docs.json          ← root file: metadata, tags, components, paths as $ref
├── paths/                 ← one index.json per URL path, folder tree mirrors the URL
│   ├── discounts/
│   │   ├── index.json     → GET /discounts
│   │   ├── detail/
│   │   │   └── index.json → GET /discounts/detail
│   │   └── ...
│   └── ...
└── shared/
    └── responses/         ← reusable response objects (422, 424, 500, …)
```

To add or modify an endpoint:

1. Edit (or create) the relevant `index.json` in `swagger/paths/`
2. If it's a new path, add a `$ref` entry in `swagger/api-docs.json` under `paths`
3. Commit the changed files

No build or compile step required.

---

## 🛣️ HTTP Routes

The package provides pre-built HTTP routes for all SDK resources. Register them in your routes file:

### Registration

```php
// routes/api.php
use ProfitabilityExodus\ProfitabilityExodusRouter;

ProfitabilityExodusRouter::routes();
```

With custom prefix and middlewares:

```php
ProfitabilityExodusRouter::routes(
    prefix: 'api/v1/profitability',
    middlewares: ['auth:sanctum', 'verified']
);
```

### Available Endpoints

All routes return JSON responses unless otherwise noted. Export endpoints return binary file content (XLSX).

#### Organization

| Method | Route | Name | Description |
|--------|-------|------|-------------|
| GET | `/organization-information` | `organization_information` | Get organization information |

#### Dedications & Payments

| Method | Route | Name | Description |
|--------|-------|------|-------------|
| GET | `/dedications-and-payments` | `dedications_and_payments` | Get dedications and payments summary |
| GET | `/dedications-and-payments/pending` | `dedications_and_payments.pending` | Get pending transfers (paginated) |
| PATCH | `/dedications-and-payments/pending/mark-transferred` | `dedications_and_payments.pending_mark_as_transferred` | Mark transfers as transferred |

#### Discounts & OTC

| Method | Route | Name | Description |
|--------|-------|------|-------------|
| GET | `/discounts` | `discounts.index` | Get discounts data |
| GET | `/discounts/detail` | `discounts.detail` | Get discounts detail |
| GET | `/discounts/generics` | `discounts.generics` | Get generics data |
| GET | `/discounts/generics/export` | `discounts.generics.export` | Export generics as XLSX |
| GET | `/discounts/free-sales/{type}` | `discounts.free_sales.index` | Get OTC list by type (PARAPHARMACY or PROMOTIONAL) |
| GET | `/discounts/free-sales/{type}/export` | `discounts.free_sales.export` | Export OTC list as XLSX |
| GET | `/discounts/free-sales/{type}/iconika/categories` | `discounts.free_sales.iconika.categories` | Get Iconika OTC categories |
| GET | `/discounts/free-sales/{type}/iconika/laboratories` | `discounts.free_sales.iconika.laboratories` | Get Iconika laboratories (paginated) |
| GET | `/discounts/free-sales/{type}/iconika/laboratories/export` | `discounts.free_sales.iconika.laboratories.export` | Export Iconika laboratories as XLSX |
| GET | `/discounts/free-sales/{type}/iconika/products` | `discounts.free_sales.iconika.products` | Get Iconika products (paginated) |
| GET | `/discounts/free-sales/{type}/iconika/products/export` | `discounts.free_sales.iconika.products.export` | Export Iconika products as XLSX |
| GET | `/discounts/free-sales/parapharmacy/iconika/filters` | `discounts.free_sales.iconika.parapharmacy.filters` | Get Iconika parapharmacy filters |

#### Generics

| Method | Route | Name | Description |
|--------|-------|------|-------------|
| GET | `/generics/{type}` | `generics` | Get generics detail by type (ACOFARMA, CONCENTRATION, or GENERIFICATION) |

#### PVP Margin

| Method | Route | Name | Description |
|--------|-------|------|-------------|
| GET | `/pvp-margin` | `pvp_margin` | Get PVP margin data |

#### OTC Detail

| Method | Route | Name | Description |
|--------|-------|------|-------------|
| GET | `/otc-detail` | `otc_detail` | Get OTC margin detail |

#### Reports

| Method | Route | Name | Description |
|--------|-------|------|-------------|
| GET | `/reports/discounts` | `reports.discounts.index` | Get discounts report |
| GET | `/reports/discounts/export` | `reports.discounts.export` | Export discounts report as XLSX |
| GET | `/reports/free-sales` | `reports.free_sales.index` | Get free sales report |
| GET | `/reports/free-sales/export` | `reports.free_sales.export` | Export free sales report as XLSX |
| GET | `/reports/generics` | `reports.generics.index` | Get generics report |
| GET | `/reports/generics/export` | `reports.generics.export` | Export generics report as XLSX |
| GET | `/reports/margins` | `reports.margins.index` | Get margins report |
| GET | `/reports/margins/export` | `reports.margins.export` | Export margins report as XLSX |
| GET | `/reports/filters/{report_type}` | `reports.filters` | Get filters for report type (DISCOUNTS, FREE_SALES, GENERICS, or MARGINS) |

### Query Parameters

Routes accept query parameters for filtering and pagination:

```php
// Pagination (where supported)
?page=1&per_page=10

// Date ranges (YYYY-mm format)
?from_month=2025-01&to_month=2025-06

// Year and months
?year=2025&months[]=1&months[]=2&months[]=3

// Organization identifier
?organization_identifier=S77776

// Laboratory filter
?laboratory=P02725

// Search/filter
?search_query=test
?filter=test

// Sort direction
?sort=ASC (or DESC)
```

---

## ⏱️ Timeout

You can override the request timeout per instance:

```php
$data = ProfitabilityExodusSDK::reports()
    ->setTimeout(30)
    ->margins('2025-01', '2025-06');
```

---

## ✅ Tests

Use the built-in fake to mock all HTTP responses in your tests:

```php
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;

ProfitabilityExodusSDK::fake();
```

This registers stubbed responses for all resources. You can also access each resource's fake responses individually:

```php
use ProfitabilityExodus\SDK\Fakes\ReportsFake;
use ProfitabilityExodus\SDK\Fakes\DiscountsFake;

ReportsFake::RESPONSE_MARGINS;
DiscountsFake::RESPONSE_LIST;
```
