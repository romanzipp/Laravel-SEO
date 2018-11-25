<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Contracts\StructContract;
use romanzipp\Seo\Structs\Struct;

class Script extends Struct implements StructContract
{
    public function tag(): string
    {
        return 'script';
    }
}
