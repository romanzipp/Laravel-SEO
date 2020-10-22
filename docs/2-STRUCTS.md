- [Basic Usage](1-INDEX.md)
  - [Add Methods](1-INDEX.md#add-methods)
  - [Macros](1-INDEX.md#macros)
- **[Structs](2-STRUCTS.md)**
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

# Structs

**Structs** are a code representation of **HTML head elements**.

## Available Shorthand Methods

Shorthand methods are **predefined shortcuts** to add commonly used Structs without the hassle of importing struct classes or chain many methods. 

When using shorthand methods, you will skip the `seo()->add()` method.
You can configure which Structs should be added on shorthand calls in the `seo.php` config file under the `shorthand` key.

### Title

```php
seo()->title(string $title = null, bool $escape = true);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Structs\Meta;

seo()->addMany([

    Title::make()
        ->body(string $title = null),

    Meta\OpenGraph::make()
        ->property('title')
        ->content(string $title = null),

    Meta\Twitter::make()
        ->name('title')
        ->content(string $title = null),

]);
```

</details>

### Description

```php
seo()->description(string $description = null, bool $escape = true);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Meta;

seo()->addMany([

    Meta\Description::make()
        ->name('description')
        ->content(string $description = null),

    Meta\OpenGraph::make()
        ->property('description')
        ->content(string $description = null),

    Meta\Twitter::make()
        ->name('description')
        ->content(string $description = null),

]);
```

</details>

### Image

```php
seo()->image(string $image = null, bool $escape = true);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Meta;

seo()->addMany([

    Meta::make()
        ->name('image')
        ->content($image, $escape),
    
    
    Meta\OpenGraph::make()
        ->property('image')
        ->content($image, $escape),
    
    
    Meta\Twitter::make()
        ->name('image')
        ->content($image, $escape),

]);
```

</details>

### Meta (name-content)

```php
seo()->meta(string $name, $content = null, bool $escape = true);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Meta;

seo()->add(
    Meta::make()
        ->name(string $name, bool $escape = true)
        ->content($content = null, bool $escape = true)
);
```

</details>

### OpenGraph

```php
seo()->og(string $property, $content = null, bool $escape = true);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;

seo()->add(
    OpenGraph::make()
        ->property(string $property, bool $escape = true)
        ->content($content = null, bool $escape = true)
);
```

</details>

### Twitter

```php
seo()->twitter(string $name, $content = null, bool $escape = true);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Meta\Twitter;

seo()->add(
    Twitter::make()
        ->name(string $name, bool $escape = true)
        ->content($content = null, bool $escape = true)
);
```

</details>

### Canonical

```php
seo()->canonical(string $canonical);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Meta\Canonical;

seo()->add(
    Canonical::make()
        ->href($canonical = null)
);
```

</details>

### CSRF Token

```php
seo()->csrfToken(string $token = null);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Meta\CsrfToken;

seo()->add(
    CsrfToken::make()
        ->href($token = null)
);
```

</details>

## Adding single structs

If you need to use more advanced elements which are not covered with shorthand setters, you can easily add single structs to your SEO instance the following way.

*Remember: [There are many methods available for adding new structs](1-INDEX.md#add-methods)* 

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
    Meta::make()
        ->attr('name', 'theme-color')
        ->attr('content', 'red')
);
```

```html
<meta name="theme-color" content="red" />
```

### OpenGraph

Because **OpenGraph** tags are `<meta />` elements, the `OpenGraph` Struct extends the `Meta` class.

All **OpenGraph** elements are defined by `property=""` and `content=""` attributes where the `property` value starts with a `og:` prefix.

Instead of using the `attr()` Struct method, we can use the shorthand `property()` and `content()` methods by the `OpenGraph` class.

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;

seo()->add(
    OpenGraph::make()
        ->attr('property', 'og:site_name')
        ->attr('content', 'This is a Site Name')
);
```

```php
use romanzipp\Seo\Structs\Meta\OpenGraph;

seo()->add(
    OpenGraph::make()
        ->property('site_name')
        ->content('Laravel')
);
```

... both render to ...

```html
<meta property="og:site_name" content="Laravel" />
```

### Twitter

**Twitter** meta tags share the same behavior as **OpenGraph** tags while the property prefix is `twitter:`.

```php
use romanzipp\Seo\Structs\Meta\Twitter;

seo()->add(
    Twitter::make()
        ->attr('name', 'twitter:card')
        ->attr('content', 'summary')
);
```

```php
use romanzipp\Seo\Structs\Meta\Twitter;

seo()->add(
    Twitter::make()
        ->name('card')
        ->content('summary')
);
```

... both render to ...

```html
<meta name="twitter:card" content="summary" />
```

## Available Structs

### Base

```php
romanzipp\Seo\Structs\Base::make();
```

### Link

```php
romanzipp\Seo\Structs\Link::make();
```

### Meta

```php
romanzipp\Seo\Structs\Meta::make();
```

```php
romanzipp\Seo\Structs\Meta\Article::make()
    ->property(string $value, bool $escape = true)
    ->content(string $value, bool $escape = true);
```

```php
romanzipp\Seo\Structs\Meta\Canonical::make()
    ->href(string $value, bool $escape = true);
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

### Noscript

```php
romanzipp\Seo\Structs\Noscript::make();
```

### Script

```php
romanzipp\Seo\Structs\Script::make();
```

### Title

```php
romanzipp\Seo\Structs\Title::make();
```

## Escaping

By default, all body and attribute content is escaped via the Laravel [`e()`](https://github.com/illuminate/support/blob/5.8/helpers.php#L607) helper function. You can change this behavior by setting the `$escape` parameter on all attribute setters.

**Use this feature with caution!**

```php
use romanzipp\Seo\Structs\Title;

Title::make()->body('Dont \' escape me!', false);
```

```php
use romanzipp\Seo\Structs\Meta;

Meta::make()->attr('content', 'Dont \' escape me!', false);
```

## Creating custom Structs

You can create your own Structs simply by extending the `romanzipp\Seo\Structs\Struct` class.

We differentiate between [**void elements**](https://www.w3.org/TR/html5/syntax.html#writing-html-documents-elements) and **normal elements**.
**Void elements**, like `<meta />` can not have a closing tag other than **normal elements** like `<title></title>`.

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
use romanzipp\Seo\Structs\Meta;

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

You are also able to modify the unique attributes by setting the `uniqueAttributes` property. If empty, just the tag name will be considered as unique.

```php
protected $uniqueAttributes = ['name'];
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
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

class Charset extends Meta
{
    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('charset', 'utf-8');
    }
}
```
