<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

class CsrfToken extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct)
    {
        $struct->attr('name', 'csrf-token');
    }

    public function token(string $token = null): self
    {
        $this->addAttribute('content', $token);

        return $this;
    }
}
