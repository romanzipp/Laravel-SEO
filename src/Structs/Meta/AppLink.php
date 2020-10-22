<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;

/**
 * @see https://github.com/joshbuchea/HEAD#app-links
 */
class AppLink extends Meta
{
    public function property($value, bool $escape = true)
    {
        $this->addAttribute('property', "al:{$value}", $escape);

        return $this;
    }
}
