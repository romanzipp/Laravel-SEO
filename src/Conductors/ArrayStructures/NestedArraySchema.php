<?php

namespace romanzipp\Seo\Conductors\ArrayStructures;

use InvalidArgumentException;

class NestedArraySchema extends AbstractArraySchema
{
    public function apply($data): void
    {
        if ( ! is_array($data)) {
            throw new InvalidArgumentException('Invalid argument supplied for nested array schema');
        }

        foreach ($data as $attribute => $value) {
            $this->call([$attribute, $value]);
        }
    }
}
