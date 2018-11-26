<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Link extends Struct
{
    protected $unique = false;

    protected function tag(): string
    {
        return 'link';
    }

    public function rel(string $value): self
    {
        $this->addAttribute('rel', $value);

        return $this;
    }

    public function href(string $value): self
    {
        $this->addAttribute('href', $value);

        return $this;
    }
}
