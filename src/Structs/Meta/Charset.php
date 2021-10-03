<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#recommended-minimum
 */
class Charset extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('charset', 'utf-8');
    }

    /**
     * @param mixed|null $charset
     * @param bool $escape
     *
     * @return $this
     */
    public function charset($charset = null, bool $escape = true)
    {
        $this->addAttribute('charset', $charset, $escape);

        return $this;
    }
}
