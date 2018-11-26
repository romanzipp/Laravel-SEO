<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Structs\Meta\Charset;
use romanzipp\Seo\Structs\Meta\Viewport;
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Test\Structs\UniqueMultiAttributeStruct;
use romanzipp\Seo\Test\Structs\UniqueSingleAttributeStruct;
use romanzipp\Seo\Test\TestCase;

class CollisionTest extends TestCase
{
    public function testShouldNotCollide()
    {
        seo()->add(
            Charset::make()
        );

        seo()->add(
            Viewport::make()->content('width=device-width, initial-scale=1')
        );

        $contents = seo()->renderContentsArray();

        $this->assertCount(2, $contents);
    }

    public function testNormalElementCollisions()
    {
        seo()->add(
            Title::make()->body('My Title')
        );

        seo()->add(
            Title::make()->body('My Second Title')
        );

        $contents = seo()->renderContentsArray();

        $this->assertCount(1, $contents);

        $this->assertEquals('<title>My Second Title</title>', $contents[0]);
    }

    public function testVoidElementSingleAttributeCollisions()
    {
        seo()->add(
            UniqueSingleAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('content', 'My Site Name')
        );

        seo()->add(
            UniqueSingleAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('content', 'My Second Site Name')
        );

        $contents = seo()->renderContentsArray();

        $this->assertCount(1, $contents);

        $this->assertRegexp('/content\=\"My Second Site Name\"/', $contents[0]);
    }

    public function testVoidElementSingleOptionalAttributeCollisions()
    {
        seo()->add(
            UniqueSingleAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('content', 'My Site Name')
        );

        seo()->add(
            UniqueSingleAttributeStruct::make()
                ->attr('second', 'unique')
                ->attr('content', 'My Second Site Name')
        );

        $contents = seo()->renderContentsArray();

        $this->assertCount(2, $contents);

        $this->assertRegexp('/content\=\"My Site Name\"/', $contents[0]);
        $this->assertRegexp('/content\=\"My Second Site Name\"/', $contents[1]);
    }

    public function testVoidElementMultipleAttributesCollisions()
    {
        seo()->add(
            UniqueMultiAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('second', 'also unique')
                ->attr('content', 'My Value')
        );

        seo()->add(
            UniqueMultiAttributeStruct::make()
                ->attr('first', 'unique')
                ->attr('second', 'also unique')
                ->attr('content', 'My Second Value')
        );

        $contents = seo()->renderContentsArray();

        $this->assertCount(1, $contents);

        $this->assertRegexp('/content\=\"My Second Value\"/', $contents[0]);
    }
}