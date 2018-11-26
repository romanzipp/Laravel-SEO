# Laravel-SEO: Hooks

## Table of Contents

- [Basic usage](index.md)
- **[Hooks](hooks.md)**
- [Struct Reference](structs.md)

## Hooks

Hooks allows the modification of either **element body** or **element attributes**.

For example, you want to append a site name to every `<title>` tag:

##### Modify the `body` of all `Title` structs.

```php
Title::hook(
    Hook::make()
        ->onBody()
        ->callback(function($body) {
            return ($body ? $body . ' | ' : '') . 'Site-Name';
        })
);
```

```php
seo()->add(
    Title::make()->body('Home')
);

seo()->title('Home');  // Home | Site-Name
seo()->title(null);    // Site-Name
```

----

##### Modify the `content` attribute of the `OpenGraph` struct which has the attribute `property` with value `og:title`

```php
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
$seo->add(
    OpenGraph::make()->property('title')->content('Home')
);

$seo->og('title', 'Home');  // Home | Site-Name
$seo->og('title', null);    // Site-Name
```
