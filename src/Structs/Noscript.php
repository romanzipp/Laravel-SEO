<?php

namespace romanzipp\Seo\Structs;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Noscript extends Struct
{
    protected function tag(): string
    {
        return 'noscript';
    }
}
