- **[Basic Usage](1-INDEX.md)**
  - [Add Methods](1-INDEX.md#add-methods)
  - [Macros](1-INDEX.md#macros)
- [Structs](2-STRUCTS.md)
  - [Available Shorthand Methods](2-STRUCTS.md#available-shorthand-methods)
  - [Adding single structs](2-STRUCTS.md#adding-single-structs)
  - [Available Structs](2-STRUCTS.md#available-structs)
  - [Escaping](2-STRUCTS.md#escaping)
  - [Creating custom Structs](2-STRUCTS.md#creating-custom-structs)
- [Hooks](3-HOOKS.md)
  - [Examples](3-HOOKS.md#examples)
  - [Reference](3-HOOKS.md#reference)
- [Laravel-Mix](4-LARAVEL-MIX.md)
- [Example App](5-EXAMPLE-APP.md)

# Basic Usage

This package offers many ways of adding new elements (**Structs**) to your `<head>`.

1. Add commonly used structs via [shorthand setters](2-STRUCTS.md#available-shorthand-methods) like `seo()->title('...')`, `seo()->meta('...')`
2. Manually add single structs via the `seo()->add()` [methods](1-INDEX.md#add-methods)
3. Specify an [array of contents](1-INDEX.md#add-from-array-format-addfromarray) via `seo()->addFromArray()`

### Recommended Minimum

For a full reference of what **could** go to your `<head>` see [joshbuchea's HEAD](https://github.com/joshbuchea/HEAD)

```php
seo()->charset('utf-8');
seo()->viewport('width=device-width, initial-scale=1, viewport-fit=cover');
seo()->title('My Title');
```

```html
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>My Title</title>
```

## Add Methods

### Add single Struct `add`

```php
use romanzipp\Seo\Structs\Title;

seo()->add(
    Title::make()->body('My Title')
);
```

### Add multiple Structs `addMany`

```php
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Structs\Meta\Description;

seo()->addMany([
    Title::make()->body('My Title'),
    Description::make()->content('My Description'),
]);
```

### Conditional additions `addIf`

```php
use romanzipp\Seo\Structs\Title;

$boolean = random_int(0, 1) === 1;

seo()->addIf(
    $boolean,
    Title::make()->body('My Title')
);
```

### Add from array format `addFromArray`

```php
seo()->addFromArray([

    // The following items share the same behavior as the equally named shorthand setters.

    'title' => 'Laravel',
    'description' => 'Laravel',
    'charset' => 'utf-8',
    'viewport' => 'width=device-width, initial-scale=1',

    // Twitter & Open Graph

    'twitter' => [
        // <meta name="twitter:card" content="summary" />
        // <meta name="twitter:creator" content="@romanzipp" />
        'card' => 'summary',
        'creator' => '@romanzipp',
    ],

    'og' => [
        // <meta property="og:locale" content="de" />
        // <meta property="og:site_name" content="Laravel" />
        'locale' => 'de',
        'site_name' => 'Laravel',
    ],

    // Custom meta & link structs. Each child array defines an attribute => value mapping.

    'meta' => [
        // <meta name="copyright" content="Roman Zipp" />
        // <meta name="theme-color" content="#f03a17" />
        [
            'name' => 'copyright',
            'content' => 'Roman Zipp',
        ],
        [
            'name' => 'theme-color',
            'content' => '#f03a17',
        ],
    ],

    'link' => [
        // <link rel="icon" href="/favicon.ico" />
        // <link rel="preload" href="/fonts/IBMPlexSans.woff2" />
        [
            'rel' => 'icon',
            'href' => '/favicon.ico',
        ],
        [
            'rel' => 'preload',
            'href' => '/fonts/IBMPlexSans.woff2',
        ],
    ],

]);
```

### Clear all added Structs

```php
seo()->clearStructs();
```

## Macros

The `romanzipp\Seo\Services\SeoService` class uses the Laravel `Macroable` trait which allows creating short macros.

### Example

Let's say you want to display a page title in the document body but added a hook to append the site name.

In this case, we'll create a macro to retreive the original Title Struct body value.

```php
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Structs\Title;

Seo::macro('getTitle', function () {

    if ( ! $title = $this->getStruct(Title::class)) {
        return null;
    }

    if ( ! $body = $title->getBody()) {
        return null;
    }

    return $body->getOriginalData();
});
```
