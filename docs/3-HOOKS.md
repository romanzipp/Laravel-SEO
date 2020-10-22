- [Basic Usage](1-INDEX.md)
  - [Add Methods](1-INDEX.md#add-methods)
  - [Macros](1-INDEX.md#macros)
- [Structs](2-STRUCTS.md)
  - [Available Shorthand Methods](2-STRUCTS.md#available-shorthand-methods)
  - [Adding single structs](2-STRUCTS.md#adding-single-structs)
  - [Available Structs](2-STRUCTS.md#available-structs)
  - [Escaping](2-STRUCTS.md#escaping)
  - [Creating custom Structs](2-STRUCTS.md#creating-custom-structs)
- **[Hooks](3-HOOKS.md)**
  - [Examples](3-HOOKS.md#examples)
  - [Reference](3-HOOKS.md#reference)
- [Laravel-Mix](4-LARAVEL-MIX.md)
- [Example App](5-EXAMPLE-APP.md)

# Hooks

Hooks allow the modification of a Structs **body** or **attributes**.

### Adding hooks to Structs

```php
use romanzipp\Seo\Helpers\Hook;

$hook = Hook::make()
    ->onBody()
    ->callback(function ($body) {
        return $body;
    });
```

**Method 1**: Call the `SeoService::hook()` method to apply a given `$hook` to a Struct class.

```php
use romanzipp\Seo\Structs\Title;

seo()->hook(Title::class, $hook);
```

**Method 2**: Apply the `$hook` directly to the Struct.

```php
use romanzipp\Seo\Structs\Title;

Title::hook($hook);
```

Both methods are basically the same, choose which one you prefer.

## Examples

For example, you want to append a site name to the body of every `<title>` tag:

#### Modify the `body` of all `Title` Structs.

```php
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Title;

Title::hook(
    Hook::make()
        ->onBody()
        ->callback(function ($body) {
            return ($body ? $body . ' | ' : '') . 'Site-Name';
        })
);
```

```php
use romanzipp\Seo\Structs\Title;

seo()->add(Title::make()->body('Home'));  // <title>Home | Site-Name</title>
seo()->add(Title::make()->body(null));    // <title>Site-Name</title>
```

----

#### Modify any attribute of the `OpenGraph` Struct which has the attribute `property` with value `og:site_name`

```php
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Meta\OpenGraph;

OpenGraph::hook(
    Hook::make()
        ->whereAttribute('property', 'og:site_name')
        ->onAttributes()
        ->callback(function ($attributes) {

            $attributes['new'] = 'This will be added to all meta tags with property="og:site_name"';

            return $attributes;
        })
);
```

----

#### Modify the `content` attribute of the `OpenGraph` Struct which has the attribute `property` with value `og:title`

```php
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Meta\OpenGraph;

OpenGraph::hook(
    Hook::make()
        ->whereAttribute('property', 'og:title')
        ->onAttribute('content')
        ->callback(function ($content) {
            return ($content ? $content . ' | ' : '') . 'Site-Name';
        })
);
```

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;

$seo->add(OpenGraph::make()->property('title')->content('Home'));  // <meta ... content="Home | Site-Name" />
$seo->add(OpenGraph::make()->property('title')->content(null));    // <meta ... content="Site-Name" />
```

## Reference

### Hook Instance

```php
use romanzipp\Seo\Helpers\Hook;

$hook = Hook::make();

$hook = new Hook;
```

### Hook Targets

#### Target Struct Body

You will receive `$body` parameter of type `null|string` in the callback function

```php

$hook
    ->onBody()
    ->callback(function ($body) {
        return $body;
    });
```

#### Target any Struct Attribute

You will receive `$attributes` parameter of type `array` in the callback function

```php
$hook
    ->onAttributes('content')
    ->callback(function ($attributes) {
        return $attributes;
    });
```

#### Target a specific Struct Attribute

You will receive `$attribute` parameter of type `null|string` in the callback function

```php
$hook
    ->onAttribute('content')
    ->callback(function ($attribute) {
        return $attribute;
    });
```

### Hook Filters

Filter Structs by `$attribute` with value `$value`

```php
$hook->whereAttribute($attribute, $value);
```
