<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

class Title extends Struct
{
    protected function tag(): string
    {
        return 'title';
    }
}
