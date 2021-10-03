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

    /**
     * @param null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function src($value = null, bool $escape = true)
    {
        $this->addAttribute('src', $value, $escape);

        return $this;
    }

    /**
     * @param null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function type($value = null, bool $escape = true)
    {
        $this->addAttribute('type', $value, $escape);

        return $this;
    }
}
