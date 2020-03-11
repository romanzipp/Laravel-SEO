<?php

namespace romanzipp\Seo\Structs;

/**
 * @see https://github.com/joshbuchea/HEAD#link
 */
class Link extends Struct
{
    protected $unique = false;

    protected function tag(): string
    {
        return 'link';
    }

    public function rel($value = null, bool $escape = true)
    {
        $this->addAttribute('rel', $value, $escape);

        return $this;
    }

    public function href($value = null, bool $escape = true)
    {
        $this->addAttribute('href', $value, $escape);

        return $this;
    }
}
