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

    public static function defaults(Struct $struct)
    {
        $struct->addAttribute('charset', 'utf-8');
    }

    public function charset(string $charset = null)
    {
        $this->addAttribute('charset', $charset);

        return $this;
    }
}
