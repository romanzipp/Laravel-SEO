<?php

namespace romanzipp\Seo\Facades;

use Illuminate\Support\Facades\Facade;
use romanzipp\Seo\Services\SeoService;

class Seo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SeoService::class;
    }
}
