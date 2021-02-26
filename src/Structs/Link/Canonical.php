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

    public function href($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('href', $value, $escape);

        return $this;
    }
}
