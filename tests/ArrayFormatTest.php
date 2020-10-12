<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Structs\Link;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Meta\Description;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Title;

class ArrayFormatTest extends TestCase
{
    // Title

    public function testTitleIndex()
    {
        seo()->addFromArray([
            'title' => 'Foo',
        ]);

        $this->assertCount(3, seo()->getStructs());

        $this->assertInstanceOf(Title::class, $struct = seo()->getStruct(Title::class));
        $this->assertEquals('Foo', (string) $struct->getBody());

        $this->assertInstanceOf(Twitter::class, $struct = seo()->getStruct(Twitter::class));
        $this->assertEquals('Foo', (string) $struct->getComputedAttribute('content'));

        $this->assertInstanceOf(OpenGraph::class, $struct = seo()->getStruct(OpenGraph::class));
        $this->assertEquals('Foo', (string) $struct->getComputedAttribute('content'));
    }

    public function testTitleIndexTagOnly()
    {
        config([
            'seo.shorthand.title.tag' => true,
            'seo.shorthand.title.opengraph' => false,
            'seo.shorthand.title.twitter' => false,
        ]);

        seo()->addFromArray([
            'title' => 'Foo',
        ]);

        $this->assertCount(1, seo()->getStructs());

        $this->assertInstanceOf(Title::class, $struct = seo()->getStruct(Title::class));
        $this->assertEquals('Foo', (string) $struct->getBody());
    }

    // Description

    public function testDescriptionIndex()
    {
        seo()->addFromArray([
            'description' => 'Foo',
        ]);

        $this->assertCount(3, seo()->getStructs());

        $this->assertInstanceOf(Description::class, $struct = seo()->getStruct(Description::class));
        $this->assertEquals('Foo', (string) $struct->getComputedAttribute('content'));

        $this->assertInstanceOf(Twitter::class, $struct = seo()->getStruct(Twitter::class));
        $this->assertEquals('Foo', (string) $struct->getComputedAttribute('content'));

        $this->assertInstanceOf(OpenGraph::class, $struct = seo()->getStruct(OpenGraph::class));
        $this->assertEquals('Foo', (string) $struct->getComputedAttribute('content'));
    }

    public function testDescriptionIndexTagOnly()
    {
        config([
            'seo.shorthand.description.tag' => true,
            'seo.shorthand.description.opengraph' => false,
            'seo.shorthand.description.twitter' => false,
        ]);

        seo()->addFromArray([
            'description' => 'Foo',
        ]);

        $this->assertCount(1, seo()->getStructs());

        $this->assertInstanceOf(Description::class, $struct = seo()->getStruct(Description::class));
        $this->assertEquals('Foo', (string) $struct->getComputedAttribute('content'));
    }

    // Twitter

    public function testTwitterIndex()
    {
        seo()->addFromArray([
            'twitter' => [
                'card' => 'summary',
            ],
        ]);

        $this->assertCount(1, seo()->getStructs());

        $this->assertInstanceOf(Twitter::class, $struct = seo()->getStruct(Twitter::class));
        $this->assertEquals('twitter:card', (string) $struct->getComputedAttribute('name'));
        $this->assertEquals('summary', (string) $struct->getComputedAttribute('content'));
    }

    // OG

    public function testOpenGraphIndex()
    {
        seo()->addFromArray([
            'og' => [
                'locale' => 'de',
            ],
        ]);

        $this->assertCount(1, seo()->getStructs());

        $this->assertInstanceOf(OpenGraph::class, $struct = seo()->getStruct(OpenGraph::class));
        $this->assertEquals('og:locale', (string) $struct->getComputedAttribute('property'));
        $this->assertEquals('de', (string) $struct->getComputedAttribute('content'));
    }

    // Meta

    public function testMetaIndex()
    {
        seo()->addFromArray([
            'meta' => [
                [
                    'name' => 'copyright',
                    'content' => 'Roman Zipp',
                ],
            ],
        ]);

        $this->assertCount(1, seo()->getStructs());

        $this->assertInstanceOf(Meta::class, $struct = seo()->getStruct(Meta::class));
        $this->assertEquals('copyright', (string) $struct->getComputedAttribute('name'));
        $this->assertEquals('Roman Zipp', (string) $struct->getComputedAttribute('content'));
    }

    public function testMetaIndexMultiple()
    {
        seo()->addFromArray([
            'meta' => [
                [
                    'name' => 'copyright',
                    'content' => 'Roman Zipp',
                ],
                [
                    'name' => 'theme-color',
                    'content' => '#3053C6',
                ],
            ],
        ]);

        $this->assertCount(2, seo()->getStructs());

        $this->assertInstanceOf(Meta::class, $struct = seo()->getStructs()[0]);
        $this->assertEquals('copyright', (string) $struct->getComputedAttribute('name'));
        $this->assertEquals('Roman Zipp', (string) $struct->getComputedAttribute('content'));

        $this->assertInstanceOf(Meta::class, $struct = seo()->getStructs()[1]);
        $this->assertEquals('theme-color', (string) $struct->getComputedAttribute('name'));
        $this->assertEquals('#3053C6', (string) $struct->getComputedAttribute('content'));
    }

    // Link

    public function testLinkIndex()
    {
        seo()->addFromArray([
            'link' => [
                [
                    'rel' => 'icon',
                    'href' => '/favicon.ico',
                ],
            ],
        ]);

        $this->assertCount(1, seo()->getStructs());

        $this->assertInstanceOf(Link::class, $struct = seo()->getStruct(Link::class));
        $this->assertEquals('icon', (string) $struct->getComputedAttribute('rel'));
        $this->assertEquals('/favicon.ico', (string) $struct->getComputedAttribute('href'));
    }

    public function testLinkIndexMultiple()
    {
        seo()->addFromArray([
            'link' => [
                [
                    'rel' => 'icon',
                    'href' => '/favicon.ico',
                ],
                [
                    'rel' => 'preload',
                    'href' => '/font.woff2',
                ],
            ],
        ]);

        $this->assertCount(2, seo()->getStructs());

        $this->assertInstanceOf(Link::class, $struct = seo()->getStructs()[0]);
        $this->assertEquals('icon', (string) $struct->getComputedAttribute('rel'));
        $this->assertEquals('/favicon.ico', (string) $struct->getComputedAttribute('href'));

        $this->assertInstanceOf(Link::class, $struct = seo()->getStructs()[1]);
        $this->assertEquals('preload', (string) $struct->getComputedAttribute('rel'));
        $this->assertEquals('/font.woff2', (string) $struct->getComputedAttribute('href'));
    }
}
