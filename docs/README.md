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

## Integrations

### Laravel-Mix

This package can automatically preload all generated frontend assets via the Laravel Mix manifest.

See the [Laravel-Mix integration docs](/laravel-mix.html) for more information.

### Schema.org

We also feature a basic integration for [Spaties Schema.org](https://github.com/spatie/schema-org) package to generate ld+json scripts.

See the [Schema.org integration docs](/schema-org.html) for more information.

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
