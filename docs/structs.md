- [Basic Usage](index.md)
- **[Structs](structs.md)**
- [Hooks](hooks.md)

# Structs

**Structs** are a code representation of **HTML elements**.

We decide between [**void elements**](https://www.w3.org/TR/html5/syntax.html#writing-html-documents-elements) and **normal elements**.
**Void elements**, like `<meta />` can not have a closing tag other than **normal elements** like `<title></title>`.

## Examples

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

### OpenGraph Meta Tags

Because **OpenGraph** tags are `<meta />` elements, the **OpenGraph** Struct is under the `Meta` namespace.

All **OpenGraph** elements are defined by `property=""` and `content=""` attributes where the `property` value starts with a `og:` prefix.

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;
```

So instead of using the `attr()` Struct method, we can use the shorthand `property()` and `content()` methods by the `OpenGraph` class.

```php
OpenGraph::make()->attr('property', 'og:site_name')->attr('content', 'This is a Site Name');
```

```php
OpenGraph::make()->property('og:site_name')->content('This is a Site Name');
```

Both compile to

```html
<meta property="og:site_name" content="This is a Site Name" />
```

## Available Structs

```php
romanzipp\Seo\Structs\Title::make();
```

```php
romanzipp\Seo\Structs\Script::make();
```

```php
romanzipp\Seo\Structs\Noscript::make();
```

```php
romanzipp\Seo\Structs\Meta::make();
romanzipp\Seo\Structs\Meta\AppLink::make()->property(string $value)->content(string $value);
romanzipp\Seo\Structs\Meta\Charset::make()->charset(string $charset);
romanzipp\Seo\Structs\Meta\OpenGraph::make()->property(string $value)->content(string $value = null);
romanzipp\Seo\Structs\Meta\Twitter::make()->name(string $value)->content(string $value);
romanzipp\Seo\Structs\Meta\Viewport::make()->content(string $content);
```

```php
romanzipp\Seo\Structs\Link::make();
```

```php
romanzipp\Seo\Structs\Base::make();
```

### Available shortcuts

```php
seo()->title(string $title = null): self
seo()->twitter(string $name, $content = null): self
seo()->og(string $property, $content = null): self
```

## Creating own Structs

You can create your own Structs simply by extending the `romanzipp\Seo\Structs\Struct` class.

```php
use romanzipp\Seo\Structs\Struct;

class MyStruct extends Struct
{
    //
}
```

#### Tag

A struct **always** requires a **tag**. This can be set by implementing the abstract `tag()` method.

```php
protected function tag(): string
{
    return 'script';
}
```

#### Uniqueness

Certain elements in a documents `<head>` can only exist once, like the `<title></title>` element.

By default, **all** Structs are unique. To change this behavior, create `unique` property and set the value to `false`.

```php
protected $unique = false;
```

Now, previous created Structs will not be removed.

```php
seo()->add(Meta::make()->attr('name', 'description')->attr('content', 'This is the FIRST description'));
seo()->add(Meta::make()->attr('name', 'description')->attr('content', 'This is the SECOND description'));
```

**Before**:

```html
<meta name="description" content="This is the SECOND description">
```

**After**:

```html
<meta name="description" content="This is the FIRST description">
<meta name="description" content="This is the SECOND description">
```
