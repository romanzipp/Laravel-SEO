# Laravel SEO

[![Latest Stable Version](https://img.shields.io/packagist/v/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![Total Downloads](https://img.shields.io/packagist/dt/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![License](https://img.shields.io/packagist/l/romanzipp/Laravel-SEO.svg?style=flat-square)](https://packagist.org/packages/romanzipp/laravel-seo)
[![Code Quality](https://img.shields.io/scrutinizer/g/romanzipp/Laravel-SEO.svg?style=flat-square)](https://scrutinizer-ci.com/g/romanzipp/Laravel-SEO/?branch=master)
[![Build Status](https://img.shields.io/travis/romanzipp/Laravel-SEO.svg?style=flat-square)](https://travis-ci.org/romanzipp/Laravel-SEO)

A SEO package made for maximum customization and flexibility.

## Installation

```
composer require romanzipp/laravel-seo
```

**If you use Laravel 5.5+ you are already done, otherwise continue.**

Add Service Provider to your `app.php` configuration file:

```php
romanzipp\Seo\Providers\SeoServiceProvider::class,
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

### Examples

#### Title

```php
use romanzipp\Seo\Structs\Title;

seo()->add(Title::make()->body('romanzipp'));
```
```php
seo()->title('romanzipp');
```

... both compile to ...

```html
<title>romanzipp</title>
```

#### Charset

```php
use romanzipp\Seo\Structs\Meta\Charset;

seo()->add(new Charset);
```

```php
use romanzipp\Seo\Structs\Meta\Charset;

seo()->add(Charset::make());
```

```php
use romanzipp\Seo\Structs\Meta\Charset;

seo()->add(Charset::make()->charset('utf-8'));
```

... all compile to ...

```html
<meta charset="utf-8" />
```

#### Twitter

```php
seo()->twitter('card', 'summary');
```

```php
use romanzipp\Seo\Structs\Meta\Twitter;

seo()->add(Twitter::make()->name('card')->content('summary'));
```

... both compile to ...

```html
<meta name="twitter:card" content="summary" />
```

#### Open Graph

```php
seo()->twitter('site_name', 'romanzipp');
```

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;

seo()->add(OpenGraph::make()->name('site_name')->content('romanzipp'));
```

... both compile to ...

```html
<meta name="og:site_name" content="romanzipp" />
```

For more information see the [Structs Documentation](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/STRUCTS.md).

### Render

```blade
{{ seo()->render() }}
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

## Cheat Sheet

| Code | Rendered HTML |
|--|--|
| `seo()->title('romanzipp')` | `<title>romanzipp</title>` |
| `seo()->meta('author', 'romanzipp')` | `<meta name="author" content="romanzipp" />` |
| `seo()->twitter('card', 'summary')` | `<meta name="twitter:card" content="summary" />` |
| `seo()->og('site_name', 'romanzipp')` | `<meta name="og:site_name" content="romanzipp" />` |
| `seo()->add(Charset::make()->charset('utf-8'))` | `<meta charset="utf-8" />` |

## Documentation

[Documentation](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/INDEX.md)

## Testing

```
./vendor/bin/phpunit
```
