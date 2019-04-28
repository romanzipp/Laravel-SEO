<?php

namespace romanzipp\Seo\Services\Traits;

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
        return $this->schemeOrgTypes;
    }

    /**
     * Add spatie/schema-org object.
     *
     * @param Type $schema schema.org Type
     */
    public function addSchema(Type $schema): self
    {
        $this->schemeOrgTypes[] = $schema;

        return $this;
    }

    /**
     * Set array of spatie/schema-org objects.
     *
     * @param array $types
     */
    public function setSchemes(array $types): self
    {
        $this->schemeOrgTypes = $types;

        return $this;
    }
}
