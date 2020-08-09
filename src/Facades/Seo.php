<?php

namespace romanzipp\Seo\Facades;

use Illuminate\Support\Facades\Facade;
use romanzipp\Seo\Services\SeoService;

/**
 * @method static void macro($name, $macro)
 * @method static void mixin($mixin, $replace = true)
 * @method static bool hasMacro($name)
 */
class Seo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SeoService::class;
    }
}
