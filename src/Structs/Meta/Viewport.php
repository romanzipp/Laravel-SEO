<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

/**
 * @see https://github.com/joshbuchea/HEAD#recommended-minimum
 */
class Viewport extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct)
    {
        $struct->attr('name', 'viewport');
    }

    public function content(string $content): self
    {
        $this->addAttribute('content', $content);

        return $this;
    }
}
