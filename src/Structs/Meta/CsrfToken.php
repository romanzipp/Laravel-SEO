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

    /**
     * @param mixed|null $token
     * @param bool $escape
     *
     * @return $this
     */
    public function token($token = null, bool $escape = true)
    {
        $this->addAttribute('content', $token, $escape);

        return $this;
    }
}
