<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;

/**
 * @see https://github.com/joshbuchea/HEAD#twitter-card
 * @see https://embedx.app
 */
class EmbedX extends Meta
{
    protected $unique = true;

    protected $uniqueAttributes = ['name'];

    /**
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return $this
     */
    public function name($value = null, bool $escape = true)
    {
        $this->addAttribute('name', "embedx:{$value}", $escape);

        return $this;
    }
}
