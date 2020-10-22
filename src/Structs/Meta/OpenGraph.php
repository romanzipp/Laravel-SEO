<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#facebook-open-graph
 */
class OpenGraph extends Meta
{
    protected $unique = true;

    protected $uniqueAttributes = ['property'];

    public function property($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('property', "og:{$value}", $escape);

        return $this;
    }
}
