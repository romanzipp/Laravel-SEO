<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Base extends Struct
{
    protected $unique = true;

    protected function tag(): string
    {
        return 'base';
    }
}
