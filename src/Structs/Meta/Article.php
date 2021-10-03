<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;

/**
 * @see https://github.com/joshbuchea/HEAD#facebook-open-graph
 */
class Article extends Meta
{
    protected $unique = true;

    protected $uniqueAttributes = ['property'];

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function property($value = null, bool $escape = true)
    {
        $this->addAttribute('property', "article:{$value}", $escape);

        return $this;
    }
}
