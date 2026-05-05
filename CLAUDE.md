# exodus-profitability-package

Laravel package that provides an HTTP client SDK and ready-to-use routes to consume profitability data from the external Exodus service.

## What it does

- Wraps every Exodus API endpoint in typed resource classes (`DedicationsAndPaymentsExodus`, `DiscountsExodus`, etc.)
- Registers Laravel routes under a configurable prefix via `ProfitabilityExodusRouter`
- Handles authentication transparently (obtains an API key from Exodus and caches it 1 h)
- Provides fake implementations for every resource to use in tests

---

## Installation

```bash
composer require fedefarma/exodus-profitability-package
```

Publish the config:

```bash
php artisan vendor:publish --tag=profitability-exodus-sdk
```

---

## Environment variables

```dotenv
PROFITABILITY_EXODUS_ENVIRONMENT=production      # or "development"
PROFITABILITY_EXODUS_API_KEY=your-api-key
PROFITABILITY_EXODUS_FORCE_BASE_URL=             # override base URL (optional)
```

---

## Registering routes

Call `ProfitabilityExodusRouter::routes()` from your `routes/api.php` or a `RouteServiceProvider`:

```php
use ProfitabilityExodus\ProfitabilityExodusRouter;

// default prefix "profitability", no extra middleware
ProfitabilityExodusRouter::routes();

// custom prefix + middleware
ProfitabilityExodusRouter::routes('api/profitability', ['auth:sanctum', 'verified']);
```

This registers all routes (organization-information, dedications-and-payments, discounts, generics, pvp-margin, otc-detail, reports, …).

---

## Using the SDK

```php
use ProfitabilityExodus\SDK\ProfitabilityExodusSDK;

// Organization info
$org = ProfitabilityExodusSDK::organization()->get();

// Dedications & payments
$list    = ProfitabilityExodusSDK::dedicationsAndPayments()->index($filters);
$pending = ProfitabilityExodusSDK::dedicationsAndPayments()->pending($filters);

// Discounts
$discounts = ProfitabilityExodusSDK::discounts()->index($filters);
$detail    = ProfitabilityExodusSDK::discounts()->detail($filters);
$generics  = ProfitabilityExodusSDK::discounts()->generics($filters);

// Generics
$generics = ProfitabilityExodusSDK::generics()->get($type, $filters);

// PVP margin
$margin = ProfitabilityExodusSDK::pvpMargin()->get($filters);

// OTC detail
$otc = ProfitabilityExodusSDK::otcDetail()->get($filters);

// Reports
$report = ProfitabilityExodusSDK::reports()->discounts($filters);
$report = ProfitabilityExodusSDK::reports()->freeSales($filters);
$report = ProfitabilityExodusSDK::reports()->generics($filters);
$report = ProfitabilityExodusSDK::reports()->margins($filters);

// Build a full Exodus URL
$url = ProfitabilityExodusSDK::url('/some/endpoint');
```

---

## Using fakes in tests

Call `ProfitabilityExodusSDK::fake()` in your test `setUp` (or at the top of a Pest test). It replaces every resource with its fake implementation — no real HTTP calls are made.

```php
// PHPUnit
protected function setUp(): void
{
    parent::setUp();
    ProfitabilityExodusSDK::fake();
}

// Pest
beforeEach(fn () => ProfitabilityExodusSDK::fake());
```

Each fake lives in `src/SDK/Fakes/` and mirrors the real resource interface.

---

## Adding a new resource

Follow this pattern:

1. **Resource** — `src/SDK/Resources/MyResourceExodus.php` extending `BaseExodus`
2. **Fake** — `src/SDK/Fakes/MyResourceFake.php` (implement the same public methods, return static fixtures)
3. **SDK entry point** — add `public static function myResource(): MyResourceExodus` to `ProfitabilityExodusSDK`
4. **Register fake** — add `MyResourceFake::fake()` inside `ExodusFake::fake()`
5. **Controller** — `src/Http/Controllers/MyResourceController.php` (thin; delegates to a use case)
6. **Use case** — `src/UseCases/MyResource/GetMyResource.php`
7. **Route** — register in `ProfitabilityExodusRouter::routes()`

`BaseExodus` handles authentication, timeout, and response parsing. Supported response types: `json`, `pdf`, `xlsx`, `image`, `async`, `none`, `status`, `with_status`.
