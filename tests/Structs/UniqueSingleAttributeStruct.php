<?php

namespace romanzipp\Seo\Test\Structs;

use romanzipp\Seo\Structs\Struct;

class UniqueSingleAttributeStruct extends Struct
{
    protected $unique = true;

    protected $uniqueAttributes = ['first'];

    protected function tag(): string
    {
        return 'unique-single-attr';
    }
}
