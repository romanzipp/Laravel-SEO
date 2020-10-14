<?php

namespace romanzipp\Seo\Structs;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Script extends Struct
{
    protected function tag(): string
    {
        return 'script';
    }

    public function src($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('src', $value, $escape);

        return $this;
    }

    public function type($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('type', $value, $escape);

        return $this;
    }
}
