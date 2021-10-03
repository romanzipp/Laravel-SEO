# Laravel SEO

[![Latest Stable Version](https://img.shields.io/packagist/v/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![Total Downloads](https://img.shields.io/packagist/dt/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![License](https://img.shields.io/packagist/l/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![GitHub Build Status](https://img.shields.io/github/workflow/status/romanzipp/Laravel-SEO/Tests?style=flat-square)](https://github.com/romanzipp/Laravel-SEO/actions)

A SEO package made for maximum customization and flexibility.

## Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Documentation](#documentation)
- [Usage](#usage)
  - [Sections](#sections)
  - [Laravel-Mix Integration](#laravel-mix-integration)
  - [Schema.org Integration](#schemaorg-integration)
- [Upgrading from 2.0 to **3.0**](#upgrading)
- [Upgrading from 1.0 to 2.0](#upgrading)
- [Cheat Sheet](#cheat-sheet)
- [Testing](#testing)

## Installation

```
composer require romanzipp/laravel-seo
```

## Configuration

Copy configuration to config folder:

```
$ php artisan vendor:publish --provider="romanzipp\Seo\Providers\SeoServiceProvider"
```

## Documentation

- **[Basic Usage](docs/1-INDEX.md)**
  - [Add Methods](docs/1-INDEX.md#add-methods)
  - [Macros](docs/1-INDEX.md#macros)
- **[Structs](docs/2-STRUCTS.md)**
  - [Available Shorthand Methods](docs/2-STRUCTS.md#available-shorthand-methods)
  - [Adding single structs](docs/2-STRUCTS.md#adding-single-structs)
  - [Available Structs](docs/2-STRUCTS.md#available-structs)
  - [Escaping](docs/2-STRUCTS.md#escaping)
  - [Creating custom Structs](docs/2-STRUCTS.md#creating-custom-structs)
- **[Hooks](docs/3-HOOKS.md)**
  - [Examples](docs/3-HOOKS.md#examples)
  - [Reference](docs/3-HOOKS.md#reference)
- **[Laravel-Mix](docs/4-LARAVEL-MIX.md)**
- **[Example App](docs/5-EXAMPLE-APP.md)**

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

1. Add commonly used structs via [shorthand setters](docs/2-STRUCTS.md#available-shorthand-methods) like `seo()->title('...')`, `seo()->meta('...')`
2. Manually add single structs via the `seo()->add()` [methods](docs/1-INDEX.md#add-methods)
3. Specify an [array of contents](docs/1-INDEX.md#add-from-array-format-addfromarray) via `seo()->addFromArray()`

Take a look at the [structs documentation](docs/2-STRUCTS.md) or [example app](docs/5-EXAMPLE-APP.md) for more detailed usage.

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

For more information see the [structs documentation](docs/2-STRUCTS.md).

## Sections

You can add structs to different **sections** by calling the `section('foo')` method on the `SeoService` instance or passing it as the first attribute to the `seo('foo')` helper method.

Sections allow you to create certain namespaces for Structs which can be used in many different ways: Distinct between "frontend" and "admin" page sections or "head" and "body" view sections.

### Using sections

```php
// This struct will be added to the "default" section
seo()->twitter('card', 'summary');

// This struct will be added to the "secondary" section
seo()->section('secondary')->twitter('card', 'image');

// This struct will be also added to the "default" section since the section() method changes are not persistent 
seo()->twitter('card', 'summary');
```

### Rendering sections

This will render all structs added to the "default" section.

```blade
{{ seo()->render() }}
```

This will render all structs added to the "secondary" section.

```blade
{{ seo()->section('secondary')->render() }}
```

Of course, you can also pass the section as parameter to the helper function.

```blade
{{ seo('secondary')->render() }}
```

## Laravel-Mix Integration

You can include your `mix-manifest.json` file generated by [Laravel-Mix](https://laravel-mix.com) to automatically add preload/prefetch link elements to your document head.

### Basic example

```php
seo()
    ->mix()
    ->load();
```

**mix-manifest.json**

```json
{
  "/js/app.js": "/js/app.js?id=123456789",
  "/css/app.css": "/css/app.css?id=123456789"
}
```

**document `<head>`**

```html
<link rel="prefetch" href="/js/app.js?id=123456789" />
<link rel="prefetch" href="/css/app.css?id=123456789" />
```

### Extended usage

Take a look at the **[SEO Laravel-Mix integration docs](docs/4-LARAVEL-MIX.md)** for further usage.

```php
use romanzipp\Seo\Conductors\Types\ManifestAsset;

seo()
    ->mix()
    ->map(static function(ManifestAsset $asset): ?ManifestAsset {

        if (strpos($asset->path, 'admin') !== false) {
            return null;
        }

        $asset->url = "http://localhost/{$asset->url}";

        return $asset;
    })
    ->load(public_path('custom-manifest.json'));
```

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

- [Upgrading from 1.0 to **3.0**](https://github.com/romanzipp/Laravel-SEO/releases/tag/3.0.0)
- [Upgrading from 1.0 to 2.0](https://github.com/romanzipp/Laravel-SEO/releases/tag/2.0.0)

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

## Testing

```
./vendor/bin/phpunit
```
