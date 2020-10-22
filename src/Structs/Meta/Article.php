<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#facebook-open-graph
 */
class Article extends Meta
{
    protected $unique = true;

    protected $uniqueAttributes = ['property'];

    public function property($value = null, bool $escape = true): Struct
    {
        $this->addAttribute('property', "article:{$value}", $escape);

        return $this;
    }
}
