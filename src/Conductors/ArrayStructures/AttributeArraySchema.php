<?php

namespace romanzipp\Seo\Conductors\ArrayStructures;

use InvalidArgumentException;

class AttributeArraySchema extends AbstractArraySchema
{
    public function apply($data)
    {
        if ( ! is_array($data)) {
            throw new InvalidArgumentException('Invalid argument supplied for attribute array schema');
        }

        foreach ($data as $attributes) {
            $this->call([
                new $this->class,
                $attributes,
            ]);
        }
    }

    protected function getCallbackParameters(): array
    {
        return [
            new $this->class,

        ];
    }

    public function acceptsSingleValue(): bool
    {
        return false;
    }
}
