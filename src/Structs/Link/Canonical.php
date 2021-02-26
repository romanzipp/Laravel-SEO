<?php

namespace romanzipp\Seo\Structs\Link;

use romanzipp\Seo\Structs\Link;
use romanzipp\Seo\Structs\Struct;

class Canonical extends Link
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('rel', 'canonical');
    }
}
