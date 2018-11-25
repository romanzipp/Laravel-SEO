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

### Presets

```php
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Structs\Presets\Charset;
use romanzipp\Seo\Structs\Presets\Twitter;
use romanzipp\Seo\Structs\Presets\OpenGraph;

// <title>romanzipp</title>

seo()->add(Title::make()->body('romanzipp'));
seo()->title('romanzipp');

// <meta charset="utf-8" />

seo()->add(Charset::make());
seo()->add(Charset::make()->charset('utf-8'));
seo()->add(new Charset);

// <meta name="twitter:card" content="summary" />

seo()->twitter('card', 'summary');
seo()->add(Twitter::make()->name('card')->content('summary'));

// <meta property="og:site_name" content="romanzipp" />

seo()->add(OpenGraph::make()->property('site_name')->content('romanzipp'));
seo()->og('site_name', 'romanzipp');
```

### Render

```php
seo()->render();
```
