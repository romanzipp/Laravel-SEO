<?php

namespace romanzipp\Seo\Structs\Meta;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Struct;

/**
 * @see  https://laravel.com/docs/csrf#csrf-x-csrf-token
 */
class CsrfToken extends Meta
{
    protected $unique = true;

    public static function defaults(Struct $struct): void
    {
        $struct->addAttribute('name', 'csrf-token');
    }

    public function token($token = null, bool $escape = true): Struct
    {
        $this->addAttribute('content', $token, $escape);

        return $this;
    }
}
