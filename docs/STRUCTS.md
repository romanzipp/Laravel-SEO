- [Basic Usage](INDEX.md)
  - [Add Methods](INDEX.md#add-methods)
  - [Macros](INDEX.md#macros)
- **[Structs](STRUCTS.md)**
  - [Examples](STRUCTS.md#examples)
  - [Available Shorthand Methods](STRUCTS.md#available-shorthand-methods)
  - [Available Structs](STRUCTS.md#available-structs)
  - [Escaping](STRUCTS.md#escaping)
  - [Creating custom Structs](STRUCTS.md#creating-custom-structs)
- [Hooks](HOOKS.md)
  - [Examples](HOOKS.md#examples)
  - [Reference](HOOKS.md#reference)
- [Laravel-Mix](LARAVEL-MIX.md)
- [Example App](EXAMPLE-APP.md)

# Structs

**Structs** are a code representation of **HTML head elements**.

We differentiate between [**void elements**](https://www.w3.org/TR/html5/syntax.html#writing-html-documents-elements) and **normal elements**.
**Void elements**, like `<meta />` can not have a closing tag other than **normal elements** like `<title></title>`.

## Examples

Always remember to add Struct instances using `seo()->add($struct)` when not using [shorthand methods](#available-shortcuts).

### Titles

```php
use romanzipp\Seo\Structs\Title;

seo()->add(
    Title::make()->body('This is a Title')
);
```

```html
<title>This is a Title</title>
```

### Meta Tags

Using the `attr(string $attribute, $value = null)` method, we can append attributes with given values.

```php
use romanzipp\Seo\Structs\Meta;

seo()->add(
    Meta::make()->attr('name', 'theme-color')->attr('content', 'red')
);
```

```html
<meta name="theme-color" content="red" />
```

### OpenGraph

Because **OpenGraph** tags are `<meta />` elements, the `OpenGraph` Struct is under the `Meta` namespace.

All **OpenGraph** elements are defined by `property=""` and `content=""` attributes where the `property` value starts with a `og:` prefix.

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;
```

So instead of using the `attr()` Struct method, we can use the shorthand `property()` and `content()` methods by the `OpenGraph` class.

```php
seo()->add(
    OpenGraph::make()
        ->attr('property', 'og:site_name')
        ->attr('content', 'This is a Site Name')
);
```

```php
seo()->add(
    OpenGraph::make()
        ->property('site_name')
        ->content('This is a Site Name')
);
```

Both compile to

```html
<meta property="og:site_name" content="This is a Site Name" />
```

### Twitter

**Twitter** meta tags share the same behavior as **OpenGraph** tags while the property prefix is `twitter:`.

```php
use romanzipp\Seo\Structs\Meta\Twitter;

seo()->add(
    Twitter::make()->name('card')->content('summary')
);
```

```html
<meta name="twitter:card" content="summary" />
```

## Available Shorthand Methods

When using shorthand methods, you will skip the `seo()->add()` method.
You can configure which Structs should be added on shorthand calls in the `seo.php` config file under the `shorthand` key.

#### Title

```php
seo()->title(string $title = null);
```

... same as ...

```php
seo()->addMany([
    Title::make()->body(string $title = null),
    OpenGraph::make()->property('title')->content(string $title = null),
    Twitter::make()->name('title')->content(string $title = null),
]);
```

#### Description

```php
seo()->description(string $description = null);
```

... same as ...

```php
seo()->addMany([
    Description::make()->name('description')->content(string $description = null),
    OpenGraph::make()->property('description')->content(string $description = null),
    Twitter::make()->name('description')->content(string $description = null),
]);
```

#### Meta name-content Tag

```php
seo()->meta(string $name, $content = null, bool $escape = true);
```

... same as ...

```php
seo()->add(
    Meta::make()
        ->name(string $name, bool $escape = true)
        ->content($content = null, bool $escape = true)
);
```

#### OpenGraph

```php
seo()->og(string $property, $content = null, bool $escape = true);
```

... same as ...

```php
seo()->add(
    OpenGraph::make()
        ->property(string $property, bool $escape = true)
        ->content($content = null, bool $escape = true)
);
```

#### Twitter

```php
seo()->twitter(string $name, $content = null, bool $escape = true);
```

... same as ...

```php
seo()->add(
    Twitter::make()
        ->name(string $name, bool $escape = true)
        ->content($content = null, bool $escape = true)
);
```

## Available Structs

#### Base

```php
romanzipp\Seo\Structs\Base::make();
```

#### Link

```php
romanzipp\Seo\Structs\Link::make();
```

#### Meta

```php
romanzipp\Seo\Structs\Meta::make();
```

```php
romanzipp\Seo\Structs\Meta\AppLink::make()
    ->property(string $value, bool $escape = true)
    ->content(string $value, bool $escape = true);
```

```php
romanzipp\Seo\Structs\Meta\Charset::make()
    ->charset(string $charset, bool $escape = true);
```

```php
romanzipp\Seo\Structs\Meta\CsrfToken::make()
    ->token($token = null, bool $escape = true);
```

```php
romanzipp\Seo\Structs\Meta\Description::make();
```

```php
romanzipp\Seo\Structs\Meta\OpenGraph::make()
    ->property(string $value, bool $escape = true)
    ->content(string $value = null, bool $escape = true);
```

```php
romanzipp\Seo\Structs\Meta\Twitter::make()
    ->name(string $value, bool $escape = true)
    ->content(string $value, bool $escape = true);
```

```php
romanzipp\Seo\Structs\Meta\Viewport::make()
    ->content(string $content, bool $escape = true);
```

#### Noscript

```php
romanzipp\Seo\Structs\Noscript::make();
```

#### Script

```php
romanzipp\Seo\Structs\Script::make();
```

#### Title

```php
romanzipp\Seo\Structs\Title::make();
```

## Escaping

By default, all body and attribute content is escaped via the Laravel [`e()`](https://github.com/illuminate/support/blob/5.8/helpers.php#L607) helper function. You can change this behavior by setting the `$escape` parameter on all attribute setters.

**Use this feature with caution!**

```php
Title::make()->body('Dont \' escape me!', false);
```

```php
Meta::make()->attr('content', 'Dont \' escape me!', false);
```

## Creating custom Structs

You can create your own Structs simply by extending the `romanzipp\Seo\Structs\Struct` class.

```php
use romanzipp\Seo\Structs\Struct;

class MyStruct extends Struct
{
    //
}
```

### Tag

A struct **always** requires a **tag**. This can be set by implementing the abstract `tag()` method.

```php
protected function tag(): string
{
    return 'script';
}
```

### Uniqueness

Certain elements in a documents `<head>` can only exist once, like the `<title></title>` element.

By default, Structs are **not** unique. To change this behavior, apply the `unique` property.

```php
protected $unique = true;
```

Now, previously created Structs will be overwritten.

```php
seo()->add(Meta::make()->attr('name', 'description')->attr('content', 'This is the FIRST description'));
seo()->add(Meta::make()->attr('name', 'description')->attr('content', 'This is the SECOND description'));
```

**Before**:

```html
<meta name="description" content="This is the FIRST description">
<meta name="description" content="This is the SECOND description">
```

**After**:

```html
<meta name="description" content="This is the SECOND description">
```

### Defaults

After a Struct instance has been created, we call the static `defaults` method.

```php
public function __construct()
{
    static::defaults($this);
}

public static function defaults(self $struct)
{
    //
}
```

By implementing the `defaults` method on your custom Struct, you can run any custom logic like adding default attributes.

This is used among others in the `romanzipp\Seo\Structs\Meta\Charset` Struct to set a default charset attribute.

```php
class Charset extends Meta
{
    public static function defaults(Struct $struct)
    {
        $struct->addAttribute('charset', 'utf-8');
    }
}
```
