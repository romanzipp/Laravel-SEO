# Laravel SEO

[![Latest Stable Version](https://img.shields.io/packagist/v/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![Total Downloads](https://img.shields.io/packagist/dt/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![License](https://img.shields.io/packagist/l/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![Code Quality](https://img.shields.io/scrutinizer/g/romanzipp/Laravel-SEO.svg?style=flat-square)](https://scrutinizer-ci.com/g/romanzipp/Laravel-SEO/?branch=master)
[![GitHub Build Status](https://img.shields.io/github/workflow/status/romanzipp/Laravel-SEO/Tests?style=flat-square)](https://github.com/romanzipp/Laravel-SEO/actions)

A SEO package made for maximum customization and flexibility.

## Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Documentation](#documentation)
- [Usage](#usage)
  - [Laravel-Mix Integration](#laravel-mix-integration)
  - [Schema.org Integration](#schemaorg-integration)
- [Upgrading from 1.0 to **2.0**](#upgrading)
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

- **[Basic Usage](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/INDEX.md)**
  - [Add Methods](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/INDEX.md#add-methods)
  - [Macros](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/INDEX.md#macros)
- **[Structs](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md)**
  - [Examples](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md#examples)
  - [Available Shorthand Methods](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md#available-shorthand-methods)
  - [Available Structs](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md#available-structs)
  - [Escaping](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md#escaping)
  - [Creating custom Structs](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md#creating-custom-structs)
- **[Hooks](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/HOOKS.md)**
  - [Examples](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/HOOKS.md#examples)
  - [Reference](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/HOOKS.md#reference)
- **[Laravel-Mix](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/LARAVEL-MIX.md)**
- **[Example App](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/EXAMPLE-APP.md)**

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

This package offers various [shorthand setters](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md#available-shortcuts) as listed below to cover commonly used meta tags for **titles**, **descriptions**, **Twitter**, **Open Graph** and more.

Take a look at the [structs documentation](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md) or [example app](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/EXAMPLE-APP.md) for more detailed usage. (*"Struct" = Code representation of head HTML elements*)

### Title

```php
seo()->title('Laravel');
```

*... renders to ...*

```html
<title>Laravel</title>
<meta property="og:title" content="Laravel" />
<meta name="twitter:title" content="Laravel" />
```

### Description

```php
seo()->description('Catchy marketing headline');
```

*... renders to ...*

```html
<meta name="description" content="Catchy marketing headline" />
<meta property="og:description" content="Catchy marketing headline" />
<meta name="twitter:description" content="Catchy marketing headline" />
```

### CSRF Token

```php
seo()->csrfToken();
```

*... renders to ...*

```html
<meta name="csrf-token" content="a7588c617ea5d8833374d8eb3752bcc4071" />
```

### Charset & Viewport

```php
seo()->charset();
seo()->viewport();
```

*... renders to ...*

```html
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
```

### Twitter

```php
seo()->twitter('card', 'summary');
seo()->twitter('creator', '@romanzipp');
```

*... renders to ...*

```html
<meta name="twitter:card" content="summary" />
<meta name="twitter:creator" content="@romanzipp" />
```

### Open Graph

```php
seo()->og('site_name', 'Laravel');
seo()->og('locale', 'de_DE');
```

*... renders to ...*

```html
<meta name="og:site_name" content="Laravel" />
<meta name="og:locale" content="de_DE" />
```

For more information see the [Structs Documentation](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md).

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

Take a look at the **[SEO Laravel-Mix integration docs](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/LARAVEL-MIX.md)** for further usage.

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

## Testing

```
./vendor/bin/phpunit
```
