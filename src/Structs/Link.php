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

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function rel($value = null, bool $escape = true)
    {
        $this->addAttribute('rel', $value, $escape);

        return $this;
    }

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function href($value = null, bool $escape = true)
    {
        $this->addAttribute('href', $value, $escape);

        return $this;
    }

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function as($value = null, bool $escape = true)
    {
        $this->addAttribute('as', $value, $escape);

        return $this;
    }

    /**
     * @param mixed|null $value
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
