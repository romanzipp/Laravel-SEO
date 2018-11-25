<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Struct;

class Script extends Struct
{
    protected $unique = false;

    protected function tag(): string
    {
        return 'script';
    }
}
