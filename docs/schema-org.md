# Schema.org Integration

This package features a basic integration for [Spaties Schema.org](https://github.com/spatie/schema-org) package to generate ld+json scripts.
Added Schema types render with the packages structs.

```php
use Spatie\SchemaOrg\Schema;

seo()->addSchema(
    Schema::localBusiness()->name('Spatie')
);
```

```php
use Spatie\SchemaOrg\Schema;

seo()->setSchemes([
    Schema::localBusiness()->name('Spatie'),
    Schema::airline()->name('Spatie'),
]);
```
