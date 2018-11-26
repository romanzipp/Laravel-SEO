<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;

/**
 * @see https://github.com/joshbuchea/HEAD#twitter-card
 */
class Twitter extends Meta
{
    protected $unique = true;

    protected $uniqueAttributes = ['name'];

    public function name(string $value = null)
    {
        $this->addAttribute('name', 'twitter:' . $value);

        return $this;
    }
}
