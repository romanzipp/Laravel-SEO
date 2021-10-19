# Introduction

## Installation

```
composer require romanzipp/laravel-seo
```

## Configuration

Copy configuration to config folder:

```
$ php artisan vendor:publish --provider="romanzipp\Seo\Providers\SeoServiceProvider"
```

## Usage

### Instantiation

```php
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Services\SeoService;

class IndexController
{
    public function index(Request $request, SeoService $seo)
    {
        $seo = seo();

        $seo = app(SeoService::class);

        $seo = Seo::make();
    }
}
```

### Render

```blade
{{ seo()->render() }}
```

## Examples

This package offers many ways of adding new elements (**Structs**) to your `<head>`.

1. Add commonly used structs via [shorthand setters](docs/structs.md#available-shorthand-methods) like `seo()->title('...')`, `seo()->meta('...')`
2. Manually add single structs via the `seo()->add()` [methods](docs/usage.md#add-methods)
3. Specify an [array of contents](docs/usage.md#add-from-array-format-addfromarray) via `seo()->addFromArray()`

Take a look at the [structs documentation](docs/structs.md) or [example app](docs/example-app.md) for more detailed usage.

### Title

```php
seo()->title('Laravel');
```

```html
<title>Laravel</title>
<meta property="og:title" content="Laravel" />
<meta name="twitter:title" content="Laravel" />
```

### Description

```php
seo()->description('Catchy marketing headline');
```

```html
<meta name="description" content="Catchy marketing headline" />
<meta property="og:description" content="Catchy marketing headline" />
<meta name="twitter:description" content="Catchy marketing headline" />
```

### CSRF Token

```php
seo()->csrfToken();
```

```html
<meta name="csrf-token" content="a7588c617ea5d8833374d8eb3752bcc4071" />
```

### Charset & Viewport

```php
seo()->charset();
seo()->viewport();
```

```html
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
```

### Twitter

```php
seo()->twitter('card', 'summary');
seo()->twitter('creator', '@romanzipp');
```

```html
<meta name="twitter:card" content="summary" />
<meta name="twitter:creator" content="@romanzipp" />
```

### Open Graph

```php
seo()->og('site_name', 'Laravel');
seo()->og('locale', 'de_DE');
```

```html
<meta name="og:site_name" content="Laravel" />
<meta name="og:locale" content="de_DE" />
```

### Meta

```php
seo()->meta('copyright', 'Roman Zipp');
```

```html
<meta name="copyright" content="Roman Zipp" />
```

For more information see the [structs documentation](docs/structs.md).

## Laravel-Mix Integration

See the full [Laravel-Mix Integration docs](/laravel-mix.html)

## Schema.org Integration

This package features a basic integration for [Spaties Schema.org](https://github.com/spatie/schema-org) package to generate ld+json scripts.
Added Schema types render with the packages structs.

```php
use Spatie\SchemaOrg\Schema;

seo()->addSchema(
    Schema::localBusiness()->name('Spatie')
);
```

```php
use Spatie\SchemaOrg\Schema;

seo()->setSchemes([
    Schema::localBusiness()->name('Spatie'),
    Schema::airline()->name('Spatie'),
]);
```

Take a look at the [Schema.org package Docs](https://github.com/spatie/schema-org#usage).

## Upgrading

- [Upgrading from 1.0 to **2.0**](https://github.com/romanzipp/Laravel-SEO/releases/tag/2.0.0)

## Cheat Sheet

| Code | Rendered HTML |
|----|----|
| **Shorthand Setters** | |
| `seo()->title('Laravel')` | `<title>Laravel</title>` |
| `seo()->description('Laravel')` | `<meta name="description" content="Laravel" />` |
| `seo()->meta('author', 'Roman Zipp')` | `<meta name="author" content="Roman Zipp" />` |
| `seo()->twitter('card', 'summary')` | `<meta name="twitter:card" content="summary" />` |
| `seo()->og('site_name', 'Laravel')` | `<meta name="og:site_name" content="Laravel" />` |
| `seo()->charset()` | `<meta charset="utf-8" />` |
| `seo()->viewport()` | `<meta name="viewport" content="width=device-width, ..." />` |
| `seo()->csrfToken()` | `<meta name="csrf-token" content="..." />` |
| **Adding Structs** | |
| `seo()->add(...)` | `<meta name="foo" />` |
| `seo()->addMany([...])` | `<meta name="foo" />` |
| `seo()->addIf(true, ...)` | `<meta name="foo" />` |
| **Various** | |
| `seo()->mix()` | |
| `seo()->hook()` | |
| `seo()->render()` | |
