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

    public function name($value = null)
    {
        $this->addAttribute('name', $value);

        return $this;
    }

    public function httpEquiv($value = null)
    {
        $this->addAttribute('http-equiv', $value);

        return $this;
    }

    public function content($value = null)
    {
        $this->addAttribute('content', $value);

        return $this;
    }
}
