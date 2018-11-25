<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Structs\Meta;

/**
 * @see https://github.com/joshbuchea/HEAD#recommended-minimum
 */
class Charset extends Meta
{
    public static function defaults($struct)
    {
        $struct->attr('charset', 'utf-8');
    }

    public function charset(string $charset): self
    {
        $this->addAttribute('charset', $charset);

        return $this;
    }
}
