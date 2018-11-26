<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Helpers\Hook;

trait HooksTrait
{
    public function hook(srting $structClass, Hook $hook): void
    {
        app($structClass)::hook($hook);
    }
}
