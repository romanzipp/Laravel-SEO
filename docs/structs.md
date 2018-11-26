# Laravel-SEO: Struct Reference

## Table of Contents

- [Basic usage](index.md)
- [Hooks](hooks.md)
- **[Struct Reference](structs.md)**

## Struct Reference

### Available structs

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
