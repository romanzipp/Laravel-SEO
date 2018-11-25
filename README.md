# Laravel SEO

A simple SEO package made for maximum customization and flexibility.

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
