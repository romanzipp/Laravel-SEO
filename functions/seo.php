<?php

use romanzipp\Seo\Services\SeoService;

if ( ! function_exists('seo')) {

    function seo()
    {
        return app(SeoService::class);
    }
}
