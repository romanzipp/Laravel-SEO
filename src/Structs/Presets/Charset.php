<?php

namespace romanzipp\Seo\Structs\Presets;

use romanzipp\Seo\Structs\Meta;

class Charset extends Meta
{
    public static function defaults($struct)
    {
        $struct->attr('charset', 'utf-8');
    }
}
