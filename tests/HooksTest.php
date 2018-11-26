<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Services\SeoService;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Test\TestCase;

class HooksTest extends TestCase
{
    public function testInstance()
    {
        $seo = app(SeoService::class);

        Title::hook(
            (new Hook)
                ->onBody()
                ->callback(function ($body) {
                    return $body . ' 1';
                })
        );

        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {
                    return $body . ' 1';
                })
        );

        OpenGraph::hook(
            Hook::make()
                ->onAttributes()
                ->whereAttribute('property', 'og:title')
                ->callback(function ($attributes) {
                    return $attributes;
                })
        );
    }
}
