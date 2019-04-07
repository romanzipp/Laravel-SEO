<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Meta extends Struct
{
    protected function tag(): string
    {
        return 'meta';
    }

    public function name($value = null, bool $escape = true)
    {
        $this->addAttribute('name', $value, $escape);

        return $this;
    }

    public function httpEquiv($value = null, bool $escape = true)
    {
        $this->addAttribute('http-equiv', $value, $escape);

        return $this;
    }

    public function content($value = null, bool $escape = true)
    {
        $this->addAttribute('content', $value, $escape);

        return $this;
    }

    public function value($value, bool $escape = true)
    {
        $this->addAttribute('value', $value, $escape);

        return $this;
    }
}
