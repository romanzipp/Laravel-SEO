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

Or add `romanzipp/laravel-seo` to your `composer.json`

```
"romanzipp/laravel-seo": "^1.0"
```

Run `composer install` to pull the latest version.

**If you use Laravel 5.5+ you are already done, otherwise continue:**

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

```php
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Structs\Meta\Charset;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Meta\OpenGraph;
```

```php
// <title>romanzipp</title>

seo()->add(Title::make()->body('romanzipp'));

seo()->title('romanzipp');
```

```php
// <meta charset="utf-8" />

seo()->add(Charset::make());

seo()->add(Charset::make()->charset('utf-8'));

seo()->add(new Charset);
```

```php
// <meta name="twitter:card" content="summary" />

seo()->twitter('card', 'summary');

seo()->add(Twitter::make()->name('card')->content('summary'));
```

```php
// <meta property="og:site_name" content="romanzipp" />

seo()->add(OpenGraph::make()->property('site_name')->content('romanzipp'));

seo()->og('site_name', 'romanzipp');
```

For more information see the [Structs Documentation](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/structs.md).

### Render

```php
seo()->render();
```

## Documentation

[Documentation](https://github.com/romanzipp/Laravel-SEO/blob/master/docs/index.md)

## Testing

```
./vendor/bin/phpunit
```
