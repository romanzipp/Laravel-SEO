<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#recommended-minimum
 */
class Viewport extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('name', 'viewport');
    }
}
