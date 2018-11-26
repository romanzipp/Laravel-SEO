# Laravel-SEO: Basic Usage

## Table of Contents

- **[Basic usage](index.md)**
- [Hooks](hooks.md)
- [Struct Reference](structs.md)

## Basic usage

For a full reference of what **could** go to your `<head>` see [joshbuchea's HEAD](https://github.com/joshbuchea/HEAD)

### Recommended Minimum

```html
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Page Title</title>
```

```php
seo()->add(Charset::make()->charset('utf-8'));
seo()->add(Viewport::make()->content('width=device-width, initial-scale=1, viewport-fit=cover'));
seo()->add(Title::make()->body('Page Title'));
```
