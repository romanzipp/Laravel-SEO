<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#link
 * @deprecated
 */
class Canonical extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('rel', 'canonical');
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
}
