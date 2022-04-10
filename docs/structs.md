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

<details>
<summary>renders to ...</summary>

```html
<title>{title}</title>
<meta property="og:title" content="{title}" />
<meta name="twitter:title" content="{title}" />
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

<details>
<summary>renders to ...</summary>

```html
<meta name="description" content="{description}" />
<meta property="og:description" content="{description}" />
<meta name="twitter:description" content="{description}" />
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

<details>
<summary>renders to ...</summary>

```html
<meta name="image" content="{image}" />
<meta property="og:image" content="{image}" />
<meta name="twitter:image" content="{image}" />
```

</details>

### Meta

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

<details>
<summary>renders to ...</summary>

```html
<meta name="{name}" content="{content}" />
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

<details>
<summary>renders to ...</summary>

```html
<meta name="og:{property}" content="{content}" />
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

<details>
<summary>renders to ...</summary>

```html
<meta name="twitter:{name}" content="{content}" />
```

</details>

### Canonical

```php
seo()->canonical(string $canonical);
```

<details>
<summary>same as ...</summary>

```php
use romanzipp\Seo\Structs\Link\Canonical;

seo()->add(
    Canonical::make()
        ->href($canonical = null)
);
```

</details>

<details>
<summary>renders to ...</summary>

```html
<link rel="canonical" href="{canonical}" />
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
        ->token($token = null)
);
```

</details>

<details>
<summary>renders to ...</summary>

```html
<meta name="csrf-token" content="{token}" />
```

</details>

## Adding single structs

If you need to use more advanced elements which are not covered with shorthand setters, you can easily add single structs to your SEO instance the following way.

*Remember: [There are many methods available for adding new structs](/usage.html#how-to-register-tags)* 

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
        ->attr('content', 'Laravel')
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

```php
romanzipp\Seo\Structs\Link\Canonical::make();
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
romanzipp\Seo\Structs\Meta\Robots::make();
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

```php
use romanzipp\Seo\Structs\Struct;

class MyStruct extends Struct
{
    //
}
```

We differentiate between [**void elements**](https://www.w3.org/TR/html5/syntax.html#writing-html-documents-elements) and **normal elements**.
**Void elements**, like `<meta />` can not have a closing tag other than **normal elements** like `<title></title>`.

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
use romanzipp\Seo\Structs\Struct;

class MyStruct extends Struct
{
   public static function defaults(self $struct): void
   {
       $struct->attr('name', 'my-description');
   }
   
   protected function tag(): string
   {
       return 'meta';
   }
}

seo()->add(MyStruct::make()->attr('name', 'This is the FIRST description'));
seo()->add(MyStruct::make()->attr('name', 'This is the SECOND description'));
```

**Before**:

```html
<meta name="my-description" content="This is the FIRST description" />
<meta name="my-description" content="This is the SECOND description" />
```

**After**:

```html
<meta name="my-description" content="This is the SECOND description" />
```

You are also able to modify the unique attributes by setting the `uniqueAttributes` property. If empty, just the tag name will be considered as unique.

```php
protected $uniqueAttributes = ['name'];
```

### Defaults

After a Struct instance has been created, we call the static `defaults` method.

```php
use romanzipp\Seo\Structs\Struct;

class MyStruct extends Struct
{
    public function __construct()
    {
        static::defaults($this);
    }

    public static function defaults(self $struct): void
    {
        //
    }
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
