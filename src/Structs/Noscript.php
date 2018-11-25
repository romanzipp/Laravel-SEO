<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Script extends Struct
{
    protected $unique = false;

    protected function tag(): string
    {
        return 'noscript';
    }
}
