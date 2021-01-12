<?php

namespace romanzipp\Seo\Collections;

use romanzipp\Seo\Collections\Contracts\CollectionContract;
use Spatie\SchemaOrg\Type;

class SchemaCollection implements CollectionContract
{
    /**
     * @var \Spatie\SchemaOrg\Type[]
     */
    protected $schemas = [];

    /**
     * @return \Spatie\SchemaOrg\Type[]
     */
    public function all(): array
    {
        return $this->schemas;
    }

    public function add(Type $schema): void
    {
        $this->schemas[] = $schema;
    }

    /**
     * @param \Spatie\SchemaOrg\Type[] $schemas
     */
    public function set(array $schemas): void
    {
        $this->schemas = $schemas;
    }
}
