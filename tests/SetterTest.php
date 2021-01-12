<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;

class SetterTest extends TestCase
{
    public function testClear()
    {
        seo()->twitter('card', 'image');

        self::assertCount(1, seo()->getStructs());

        seo()->clearStructs();

        self::assertCount(0, seo()->getStructs());
    }

    public function testSetOverride()
    {
        seo()->twitter('card', 'image');

        self::assertCount(1, seo()->getStructs());

        seo()->setStructCollection([
            OpenGraph::make(),
        ]);

        self::assertCount(1, seo()->getStructs());
        self::assertInstanceOf(OpenGraph::class, seo()->getStruct(OpenGraph::class));
    }

    public function testAdd()
    {
        seo()->add(Twitter::make());

        self::assertCount(1, seo()->getStructs());

        seo()->add(OpenGraph::make());

        self::assertCount(2, seo()->getStructs());
    }

    public function testAddIf()
    {
        seo()->addIf(false, Twitter::make());

        self::assertCount(0, seo()->getStructs());

        seo()->addIf(true, Twitter::make());

        self::assertCount(1, seo()->getStructs());
    }
}
