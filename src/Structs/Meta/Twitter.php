<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#twitter-card
 */
class Twitter extends Meta
{
    protected $unique = true;

    protected $uniqueAttributes = ['name'];

    public function name($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('name', "twitter:{$value}", $escape);

        return $this;
    }
}
