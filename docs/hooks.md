# Laravel-SEO: Hooks

## Table of Contents

- [Basic usage](index.md)
- **[Hooks](hooks.md)**
- [Struct Reference](structs.md)

## Examples

Hooks allows the modification of either **element body** or **element attributes**.

### Adding hooks to structs

```php
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Title;

$hook = Hook::make()->onBody()->callback($callback);

seo()->hook(Title::class, $hook);

Title::hook($hook);
```

For example, you want to append a site name to every `<title>` tag:

##### Modify the `body` of all `Title` structs.

```php
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Title;

Title::hook(
    Hook::make()
        ->onBody()
        ->callback(function($body) {
            return ($body ? $body . ' | ' : '') . 'Site-Name';
        })
);
```

```php
use romanzipp\Seo\Structs\Title;

seo()->add(
    Title::make()->body('Home')
);

seo()->title('Home');  // Home | Site-Name
seo()->title(null);    // Site-Name
```

----

##### Modify the `content` attribute of the `OpenGraph` struct which has the attribute `property` with value `og:title`

```php
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Meta\OpenGraph;

OpenGraph::hook(
    Hook::make()
        ->whereAttribute('property', 'og:title')
        ->onAttribute('content')
        ->callback(function($content) {
            return ($content ? $content . ' | ' : '') . 'Site-Name';
        })
);
```

----

##### Modify any attribute of the `OpenGraph` struct which has the attribute `property` with value `og:site_name`

```php
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Meta\OpenGraph;

OpenGraph::hook(
    Hook::make()
        ->whereAttribute('property', 'og:site_name')
        ->onAttributes()
        ->callback(function($attributes) {

            $attributes['data-new'] = 'This will be added to all og:site_name meta tags';

            return $attributes;
        })
);
```

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;

$seo->add(
    OpenGraph::make()->property('title')->content('Home')
);

$seo->og('title', 'Home');  // Home | Site-Name
$seo->og('title', null);    // Site-Name
```

## Reference

### Hooks Instance

```php
use romanzipp\Seo\Helpers\Hook;

$hook = Hook::make();

$hook = new Hook;
```

### Hooks Targets

#### Target Struct Body

You will receive `$body` parameter of type `null|string` in the callback function

```php

$hook
    ->onBody()
    ->callback(function($body) {
        return $body;
    });
```

#### Target any Struct Attribute

You will receive `$attributes` parameter of type `array` in the callback function

```php
$hook
    ->whereAttribute('property', 'og:title')
    ->onAttributes('content')
    ->callback(function($attributes) {
        return $attributes;
    })
```

#### Target a specific Struct Attribute

You will receive `$attribute` parameter of type `null|string` in the callback function

```php
$hook
    ->whereAttribute('property', 'og:title')
    ->onAttribute('content')
    ->callback(function($content) {
        return ($content ? $content . ' | ' : '') . 'Site-Name';
    })
```
