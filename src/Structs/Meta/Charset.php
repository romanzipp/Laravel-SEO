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

    public function charset($charset = null, bool $escape = true): Struct
    {
        $this->addAttribute('charset', $charset, $escape);

        return $this;
    }
}
