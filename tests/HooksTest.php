<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Title;

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

        $contents = seo()->render()->toArray();

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

        $contents = seo()->render()->toArray();

        $this->assertEquals('<title>My Title 1 2</title>', $contents[0]);

        Title::clearHooks();
    }

    public function testBodyHookMultipleExecutions()
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

        seo()->add(
            Title::make()->body('Some Title')
        );

        $contents = seo()->render()->toArray();

        $this->assertEquals('<title>Some Title 1</title>', $contents[0]);

        Title::clearHooks();
    }

    public function testExistingAttributesHooks()
    {
        OpenGraph::hook(
            Hook::make()
                ->onAttributes()
                ->whereAttribute('property', 'og:title')
                ->callback(function ($attributes) {
                    return array_merge($attributes, ['content' => 'My Second Title']);
                })
        );

        seo()->add(
            OpenGraph::make()->property('title')->content('My Title')
        );

        $contents = seo()->render()->toArray();

        $this->assertMatchesRegularExpression('/content\=\"My Second Title\"/', $contents[0]);

        OpenGraph::clearHooks();
    }

    public function testAppendingAttributesHooks()
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

        $contents = seo()->render()->toArray();

        $this->assertMatchesRegularExpression('/should\=\"exist\"/', $contents[0]);

        OpenGraph::clearHooks();
    }

    public function testAttributeHooks()
    {
        OpenGraph::hook(
            Hook::make()
                ->onAttribute('content')
                ->whereAttribute('property', 'og:title')
                ->callback(function ($content) {
                    return $content . ' 1';
                })
        );

        seo()->add(
            OpenGraph::make()->property('title')->content('My Title')
        );

        $contents = seo()->render()->toArray();

        $this->assertMatchesRegularExpression('/content\=\"My Title 1\"/', $contents[0]);

        OpenGraph::clearHooks();
    }

    public function testEmptyStructTargetHooks()
    {
        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {
                    return $body . ' 1';
                })
        );

        seo()->add(
            Title::make()->attr('ignore', 'me')
        );

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        Title::clearHooks();
    }
}
