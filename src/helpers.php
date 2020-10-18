<?php

use romanzipp\Seo\Services\SeoService;

if ( ! function_exists('seo')) {
    /**
     * Create SeoService instance.
     *
     * @return \romanzipp\Seo\Services\SeoService
     */
    function seo(): SeoService
    {
        return app(SeoService::class);
    }
}
