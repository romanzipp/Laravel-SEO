<?php

namespace romanzipp\Seo\Conductors\ArrayStructures;

class AttributeArraySchema extends AbstractArraySchema
{
    /**
     * @param array<array<string>> $data
     */
    public function apply($data): void
    {
        if ( ! is_array($data)) {
            throw new \InvalidArgumentException('Invalid argument supplied for attribute array schema');
        }

        foreach ($data as $attributes) {
            $this->call([
                new $this->class(),
                $attributes,
            ]);
        }
    }
}
