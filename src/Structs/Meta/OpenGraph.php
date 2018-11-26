<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;

/**
 * @see https://github.com/joshbuchea/HEAD#facebook-open-graph
 */
class OpenGraph extends Meta
{
    protected $unique = true;

    protected $uniqueAttributes = ['property'];

    public function property(string $value = null): self
    {
        $this->addAttribute('property', 'og:' . $value);

        return $this;
    }
}
