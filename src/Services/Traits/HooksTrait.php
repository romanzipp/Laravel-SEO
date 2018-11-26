<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Helpers\Hook;

trait HooksTrait
{
    /**
     * Add hook to given struct class. This is just an
     * alias for the Struct::hook() method.
     *
     * @param  string $structClass
     * @param  Hook   $hook
     * @return void
     */
    public function hook(string $structClass, Hook $hook): void
    {
        app($structClass)::hook($hook);
    }
}
