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

## Extended Usage

### Manipulation

The package allows you to define certain manipulations for either **element body** or **element attributes**.

For example, you want to append a site name to every `<title>` tag:

```php
use romanzipp\Seo\Structs\Title;

// Manipulate the body of all Title structs

seo()->manipulateBody(Title::class, function ($body) {
    return ($body ? $body . ' | ' : '') . 'Site-Name';
});

// Add seo Title struct

seo()->add(Title::make()->body('Home'));  // Home | Site-Name

// Or use the title() shortcut

seo()->title('Home');  // Home | Site-Name
seo()->title(null);    // Site-Name
```

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;

// Manipulate OpenGraph structs with the attribute "property" and value "og:title"

seo()->manipulateAttributes(OpenGraph::class, ['property' => 'og:title'], function ($attributes) {

    // $attributes is an associative array with all
    // struct/element attributes

    if ( ! empty($attributes['content'])) {
        $attributes['content'] .= ' | ';
    }

    $attributes['content'] .= 'Site-Name';

    return $attributes;
});

// Add seo OpenGraph struct

$seo->add(
    OpenGraph::make()->property('title')->content('Home')
);

// Or use the og() shortcut

$seo->og('title', 'Home');
$seo->og('title', null);
```
