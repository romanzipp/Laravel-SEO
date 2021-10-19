# Usage

## Instantiation

You can access the SEO service in many different ways. Just use what you prefer! We will use the `seo()` function in this documentaiton.

```php
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Services\SeoService;

$seo = seo();

$seo = app(SeoService::class);

$seo = Seo::make();
```

## Render

Place this code snippet in your blade view.

```blade
{{ seo()->render() }}
```

## How to register tags

ℹ️ Going forward we will refer to head/meta elements as **Structs**.

This package offers many ways of adding new elements (**Structs**) to your `<head>`.

1. Add commonly used structs via [shorthand setters](#shorthand-setters) like `seo()->title('...')`
2. Manually add single structs via the `seo()->add()` [methods](#add-structs)
3. Specify an [array of contents](#array-format) via `seo()->addFromArray()`

### Shorthand setters

Shorthand setters are **predefined shortcuts** to add commonly used Structs without the hassle of importing struct classes or chain many methods.

When using shorthand methods, you will skip the `seo()->add()` method.
You can configure which Structs should be added on shorthand calls in the `seo.php` config file under the `shorthand` key.

#### Title

```php
seo()->title('Laravel');
```

... renders to ...

```html
<title>Laravel</title>
<meta property="og:title" content="Laravel" />
<meta name="twitter:title" content="Laravel" />
```

#### Meta

```php
seo()->meta('copyright', 'Roman Zipp');
```

... renders to ...

```html
<meta name="copyright" content="Roman Zipp" />
```

Take a look at the [shorthand setter docs](/structs.html#available-shorthand-methods) for all available methods.

### Add Structs

If you need to use more advanced elements which are not covered with shorthand setters, you can easily add single structs to your SEO instance the following way.

Further reading: [Adding single structs](/structs.html#adding-single-structs)

#### Single Structs

```php
use romanzipp\Seo\Structs\Title;

seo()->add(
    Title::make()->body('My Title')
);
```

#### Multiple Structs

```php
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Structs\Meta\Description;

seo()->addMany([
    Title::make()->body('My Title'),
    Description::make()->content('My Description'),
]);
```

#### Conditional additions

```php
use romanzipp\Seo\Structs\Title;

$boolean = random_int(0, 1) === 1;

seo()->addIf(
    $boolean,
    Title::make()->body('My Title')
);
```

### Array format

You can also register structs using the following format. This can be helpful if you are fetching SEO information from a database.

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

## Sections

You can add structs to different **sections** by calling the `section('foo')` method on the `SeoService` instance or passing it as the first attribute to the `seo('foo')` helper method. By default all Structs will be added to the "default" section.

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

You can also pass the section as parameter to the helper function.

```php
seo('secondary')->twitter('card', 'image');
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

### Using sections with dependency resolving

```php
use romanzipp\Seo\Services\SeoService;

$seo = app(SeoService::class);

// will be applied to "default" section
$seo->twitter('card', 'summary');

// will be applied to "secondary" section
$seo->section('secondary')->twitter('card', 'summary');

// WARNING!
// This struct will be applied to the "secondary" section since the service instance has been resolved
// once and was set to "secondary" section in the previous step
$seo->twitter('card', 'summary');
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

## Recommended Minimum

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

## Clear all added Structs

```php
seo()->clearStructs();
```
