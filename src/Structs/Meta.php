<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Meta extends Struct
{
    protected function tag(): string
    {
        return 'meta';
    }
}
