<?php

namespace romanzipp\Seo\Structs\Presets;

use romanzipp\Seo\Structs\Meta;

class Twitter extends Meta
{
    public function name(string $value): self
    {
        $this->addAttribute('name', 'twitter:' . $value);

        return $this;
    }

    public function content(string $value): self
    {
        $this->addAttribute('content', $value);

        return $this;
    }
}
