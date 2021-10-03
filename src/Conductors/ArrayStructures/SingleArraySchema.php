<?php

namespace romanzipp\Seo\Conductors\ArrayStructures;

use InvalidArgumentException;

class SingleArraySchema extends AbstractArraySchema
{
    /**
     * @param string $value
     */
    public function apply($value): void
    {
        if ( ! is_string($value)) {
            throw new InvalidArgumentException('Invalid argument supplied for single array schema');
        }

        $this->call([
            $value,
        ]);
    }
}
