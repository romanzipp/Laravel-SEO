<?php

namespace romanzipp\Seo\Structs;

/**
 * @see https://github.com/joshbuchea/HEAD#meta
 */
class Meta extends Struct
{
    protected function tag(): string
    {
        return 'meta';
    }

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function name($value = null, bool $escape = true)
    {
        $this->addAttribute('name', $value, $escape);

        return $this;
    }

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function httpEquiv($value = null, bool $escape = true)
    {
        $this->addAttribute('http-equiv', $value, $escape);

        return $this;
    }

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function content($value = null, bool $escape = true)
    {
        $this->addAttribute('content', $value, $escape);

        return $this;
    }

    /**
     * @param mixed $value
     * @param bool $escape
     *
     * @return $this
     */
    public function value($value, bool $escape = true)
    {
        $this->addAttribute('value', $value, $escape);

        return $this;
    }
}
