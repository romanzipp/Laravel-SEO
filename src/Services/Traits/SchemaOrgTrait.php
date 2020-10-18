<?php

namespace romanzipp\Seo\Services\Traits;

use Illuminate\Support\Arr;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Type;

trait SchemaOrgTrait
{
    /**
     * Get spatie/schema-org types.
     *
     * @return array
     */
    public function getSchemes(): array
    {
        return $this->schemaOrgTypes;
    }

    /**
     * Add spatie/schema-org object.
     *
     * @param Type $schema schema.org Type
     *
     * @return self
     */
    public function addSchema(Type $schema): self
    {
        $this->schemaOrgTypes[] = $schema;

        return $this;
    }

    /**
     * Set array of spatie/schema-org objects.
     *
     * @param array $types
     *
     * @return self
     */
    public function setSchemes(array $types): self
    {
        $this->schemaOrgTypes = $types;

        return $this;
    }

    /**
     * Add a list of breadcrumbs.
     *
     * @param array $crumbs
     *
     * @return self
     */
    public function addSchemaBreadcrumbs(array $crumbs): self
    {
        $itemListElement = [];

        foreach ($crumbs as $key => $crumb) {
            $itemListElement[] = Schema::listItem()
                ->position($key + 1)
                ->name(
                    Arr::get($crumb, 'name')
                )
                ->item(
                    Arr::get($crumb, 'item')
                );
        }

        $this->addSchema(
            Schema::breadcrumbList()
                ->itemListElement($itemListElement)
        );

        return $this;
    }
}
