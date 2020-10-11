<?php

namespace romanzipp\Seo\Conductors\ArrayStructures;

use InvalidArgumentException;

class NestedArraySchema extends AbstractArraySchema
{
    public function apply($data)
    {
        if ( ! is_array($data)) {
            throw new InvalidArgumentException('Invalid argument supplied for nested array schema');
        }

        foreach ($data as $key => $value) {
            $this->call([$key, $value]);
        }
    }

    public function acceptsSingleValue(): bool
    {
        return false;
    }
}
