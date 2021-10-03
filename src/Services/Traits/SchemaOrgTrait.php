<?php

namespace romanzipp\Seo\Services\Traits;

use Illuminate\Support\Arr;
use romanzipp\Seo\Schema\Schema as SchemaContainer;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Type;

trait SchemaOrgTrait
{
    /**
     * Get spatie/schema-org types.
     *
     * @return \Spatie\SchemaOrg\Type[]
     */
    public function getSchemes(): array
    {
        return array_values(
            array_map(
                static function (SchemaContainer $container): Type {
                    return $container->getType();
                },
                array_filter(
                    $this->schemaCollection->all(),
                    function (SchemaContainer $container): bool {
                        return $container->getSection() === $this->section;
                    }
                )
            )
        );
    }

    /**
     * Add spatie/schema-org object.
     *
     * @param Type $schema schema.org Type
     *
     * @return $this
     */
    public function addSchema(Type $schema): self
    {
        $container = new SchemaContainer($schema);
        $container->setSection($this->section);

        $this->schemaCollection->add($container);

        return $this;
    }

    /**
     * Set array of spatie/schema-org objects.
     *
     * @param \Spatie\SchemaOrg\Type[] $schemes
     *
     * @return $this
     */
    public function setSchemes(array $schemes): self
    {
        $containers = [];

        foreach ($schemes as $schema) {
            $container = new SchemaContainer($schema);
            $container->setSection($this->section);

            $containers[] = $container;
        }

        $this->schemaCollection->set($containers);

        return $this;
    }

    /**
     * Add a list of breadcrumbs.
     *
     * @param array<array<string, string>> $crumbs
     *
     * @return $this
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
