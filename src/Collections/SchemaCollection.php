<?php

namespace romanzipp\Seo\Collections;

use romanzipp\Seo\Collections\Contracts\CollectionContract;
use romanzipp\Seo\Schema\Schema as SchemaContainer;

class SchemaCollection implements CollectionContract
{
    /**
     * @var \romanzipp\Seo\Schema\Schema[]
     */
    protected $schemas = [];

    /**
     * @return \romanzipp\Seo\Schema\Schema[]
     */
    public function all(): array
    {
        return $this->schemas;
    }

    public function add(SchemaContainer $schema): void
    {
        $this->schemas[] = $schema;
    }

    /**
     * @param \romanzipp\Seo\Schema\Schema[] $schemas
     */
    public function set(array $schemas): void
    {
        $this->schemas = $schemas;
    }
}
