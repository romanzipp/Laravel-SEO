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

    public function rel($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('rel', $value, $escape);

        return $this;
    }

    public function href($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('href', $value, $escape);

        return $this;
    }

    public function as($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('as', $value, $escape);

        return $this;
    }

    public function type($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('type', $value, $escape);

        return $this;
    }
}
