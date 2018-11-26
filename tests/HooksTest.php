<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Test\TestCase;

class HooksTest extends TestCase
{
    public function testBodyHooks()
    {
        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {
                    return $body . ' 1';
                })
        );

        seo()->add(
            Title::make()->body('My Title')
        );

        $contents = seo()->renderContentsArray();

        $this->assertCount(1, $contents);

        $this->assertEquals('<title>My Title 1</title>', $contents[0]);

        Title::clearHooks();
    }

    public function testMultipleBodyHooks()
    {
        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {
                    return $body . ' 1';
                })
        );

        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {
                    return $body . ' 2';
                })
        );

        seo()->add(
            Title::make()->body('My Title')
        );

        $contents = seo()->renderContentsArray();

        $this->assertEquals('<title>My Title 1 2</title>', $contents[0]);

        Title::clearHooks();
    }

    public function testAttributesHooks()
    {
        OpenGraph::hook(
            Hook::make()
                ->onAttributes()
                ->whereAttribute('property', 'og:title')
                ->callback(function ($attributes) {
                    return array_merge(['should' => 'exist'], $attributes);
                })
        );

        seo()->add(
            OpenGraph::make()->property('title')->content('My Title')
        );

        $contents = seo()->renderContentsArray();

        $this->assertRegexp('/should\=\"exist\"/', $contents[0]);

        OpenGraph::clearHooks();
    }
}
