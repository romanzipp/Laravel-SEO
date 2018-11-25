<?php

namespace romanzipp\Seo\Structs\Presets;

use romanzipp\Seo\Structs\Meta;

class OpenGraph extends Meta
{
    public function property(string $value): self
    {
        $this->addAttribute('property', 'og:' . $value);

        return $this;
    }

    public function content(string $value): self
    {
        $this->addAttribute('content', $value);

        return $this;
    }
}
