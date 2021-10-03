<?php

namespace romanzipp\Seo\Schema;

use romanzipp\Seo\Structs\Struct;
use Spatie\SchemaOrg\Type;

final class Schema
{
    /**
     * @var \Spatie\SchemaOrg\Type
     */
    private $type;

    /**
     * @var string
     */
    private $section;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    /**
     * Get the schema type.
     *
     * @return \Spatie\SchemaOrg\Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * Get the section in which the struct should rest. Default: "default".
     *
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * Set the section. This is mainly done in the SeoService class.
     *
     * @param string $section
     *
     * @return $this
     */
    public function setSection(string $section): self
    {
        $this->section = $section;

        return $this;
    }
}
