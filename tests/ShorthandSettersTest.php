<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Meta\Canonical;
use romanzipp\Seo\Structs\Meta\Charset;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Meta\Viewport;

class ShorthandSettersTest extends TestCase
{
    public function testTitleSingleSetter()
    {
        config([
            'seo.shorthand.title.tag' => true,
            'seo.shorthand.title.twitter' => false,
            'seo.shorthand.title.opengraph' => false,
        ]);

        seo()->title('My Title');

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);
    }

    public function testTitleMultipleSetter()
    {
        config([
            'seo.shorthand.title.tag' => true,
            'seo.shorthand.title.twitter' => true,
            'seo.shorthand.title.opengraph' => true,
        ]);

        seo()->title('My Title');

        $contents = seo()->render()->toArray();

        $this->assertCount(3, $contents);
    }

    public function testDescriptionSingleSetter()
    {
        config([
            'seo.shorthand.description.meta' => true,
            'seo.shorthand.description.twitter' => false,
            'seo.shorthand.description.opengraph' => false,
        ]);

        seo()->description('My Description');

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);
    }

    public function testDescriptionMultipleSetter()
    {
        config([
            'seo.shorthand.description.meta' => true,
            'seo.shorthand.description.twitter' => true,
            'seo.shorthand.description.opengraph' => true,
        ]);

        seo()->description('My Description');

        $contents = seo()->render()->toArray();

        $this->assertCount(3, $contents);
    }

    public function testTwitterSetter()
    {
        seo()->twitter('card', 'summary');

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertInstanceOf(Twitter::class, seo()->getStructs()[0]);
    }

    public function testOpenGraphSetter()
    {
        seo()->og('site_name', 'My Site Name');

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertInstanceOf(OpenGraph::class, seo()->getStructs()[0]);
    }

    public function testMetaSetter()
    {
        seo()->meta('author', 'My Little Pony');

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertInstanceOf(Meta::class, seo()->getStructs()[0]);
    }

    public function testCharsetSetter()
    {
        seo()->charset('utf-8');

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertInstanceOf(Charset::class, seo()->getStructs()[0]);
    }

    public function testViewportSetter()
    {
        seo()->viewport('width=device-width, initial-scale=1');

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertInstanceOf(Viewport::class, seo()->getStructs()[0]);
    }

    public function testCanonicalSetter()
    {
        seo()->canonical('https://test.com/example');

        $contents = seo()->render()->toArray();

        $this->assertCount(1, $contents);

        $this->assertInstanceOf(Canonical::class, seo()->getStructs()[0]);
    }
}
