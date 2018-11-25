<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

class Meta extends Struct
{
    protected function tag(): string
    {
        return 'meta';
    }
}
