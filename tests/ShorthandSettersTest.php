<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Test\TestCase;

class ShorthandSettersTest extends TestCase
{
    public function testTitleSetter()
    {
        seo()->title('My Title');

        $contents = seo()->renderContentsArray();

        $this->assertCount(2, $contents);
    }

    public function testDescriptionSetter()
    {
        seo()->title('My Title');

        $contents = seo()->renderContentsArray();

        $this->assertCount(2, $contents);
    }

    public function testTwitterSetter()
    {
        seo()->twitter('card', 'summary');

        $contents = seo()->renderContentsArray();

        $this->assertCount(1, $contents);

        $this->assertInstanceOf(Twitter::class, seo()->getStructs()[0]);
    }

    public function setOpenGraphSetter()
    {
        seo()->og('site_name', 'My Site Name');

        $contents = seo()->renderContentsArray();

        $this->assertCount(1, $contents);

        $this->assertInstanceOf(OpenGraph::class, seo()->getStructs()[0]);
    }
}
