<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

class Base extends Struct
{
    protected function tag(): string
    {
        return 'base';
    }
}
