<?php

namespace romanzipp\Seo\Test\Structs;

use romanzipp\Seo\Structs\Struct;

class UniqueMultiAttributeStruct extends Struct
{
    protected $unique = true;

    protected $uniqueAttributes = ['first', 'second'];

    protected function tag(): string
    {
        return 'unique-multi-attr';
    }
}
