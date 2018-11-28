- [Basic Usage](INDEX.md)
- **[Structs](STRUCTS.md)**
- [Hooks](HOOKS.md)

# Structs

**Structs** are a code representation of **HTML elements**.

We differentiate between [**void elements**](https://www.w3.org/TR/html5/syntax.html#writing-html-documents-elements) and **normal elements**.
**Void elements**, like `<meta />` can not have a closing tag other than **normal elements** like `<title></title>`.

## Examples

For simplicity reasons, we only show the Struct declaration. Always remember to add Structs using `seo()->add($struct)`.

### Titles

```php
use romanzipp\Seo\Structs\Title;

Title::make()->body('This is a Title');
```

```html
<title>This is a Title</title>
```

### Meta Tags

Using the `attr(string $attribute, $value = null)` method, we can append attributes with given values.

```php
use romanzipp\Seo\Structs\Meta;

Meta::make()->attr('name', 'theme-color')->attr('content', 'red');
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
OpenGraph::make()->attr('property', 'og:site_name')->attr('content', 'This is a Site Name');
```

```php
OpenGraph::make()->property('site_name')->content('This is a Site Name');
```

Both compile to

```html
<meta property="og:site_name" content="This is a Site Name" />
```

### Twitter

**Twitter** meta tags share the same behavior as **OpenGraph** tags while the property prefix is `twitter:`.

```php
use romanzipp\Seo\Structs\Meta\Twitter;

Twitter::make()->name('card')->content('summary');
```

```html
<meta name="twitter:card" content="summary" />
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
    ->property(string $value)
    ->content(string $value);
```

```php
romanzipp\Seo\Structs\Meta\Charset::make()
    ->charset(string $charset);
```

```php
romanzipp\Seo\Structs\Meta\OpenGraph::make()
    ->property(string $value)
    ->content(string $value = null);
```

```php
romanzipp\Seo\Structs\Meta\Twitter::make()
    ->name(string $value)
    ->content(string $value);
```

```php
romanzipp\Seo\Structs\Meta\Viewport::make()
    ->content(string $content);
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

## Available Shortcuts

#### Title

```php
seo()->title(string $title = null): self
```

... same as ...

```php
Title::make()->body(string $title = null): self
OpenGraph::make()->property('title')->content(string $title = null): self
```

#### Description

```php
seo()->description(string $description = null): self
```

... same as ...

```php
Description::make()->name('description')->content(string $description = null): self
OpenGraph::make()->property('description')->content(string $description = null): self
```

#### OpenGraph

```php
seo()->og(string $property, $content = null): self
```

... same as ...

```php
OpenGraph::make()->property(string $property)->content($content = null): self
```

#### Twitter

```php
seo()->twitter(string $name, $content = null): self
```

... same as ...

```php
Twitter::make()->name(string $name)->content($content = null): self
```

## Escaping

By default, all body and attribute content is escaped. You can change this behavior by setting the `$escape` parameter on both body and attribute setters.

**Use this feature with caution!**

```php
public function body($body, bool $escape = true): self
{
    // ...
}

public function attr(string $attribute, $value = null, bool $escape = true): self
{
    // ...
}
```

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

After a Struct instance has been created, we call the static `deftaults` method.

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
