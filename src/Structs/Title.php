<?php

namespace romanzipp\Seo\Structs;

/**
 * @see https://github.com/joshbuchea/HEAD#elements
 */
class Title extends Struct
{
    protected $unique = true;

    protected function tag(): string
    {
        return 'title';
    }
}
