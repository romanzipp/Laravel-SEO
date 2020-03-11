<?php

namespace romanzipp\Seo\Structs;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Script extends Struct
{
    protected function tag(): string
    {
        return 'script';
    }
}
