<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

class Link extends Struct
{
    protected function tag(): string
    {
        return 'link';
    }
}
