<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Meta\Description;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Title;

class ArrayFormatTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        config([
            'seo.shorthand.title.tag' => true,
            'seo.shorthand.title.opengraph' => false,
            'seo.shorthand.title.twitter' => false,
            'seo.shorthand.description.tag' => true,
            'seo.shorthand.description.opengraph' => false,
            'seo.shorthand.description.twitter' => false,
        ]);
    }

    public function testAddingSingleSchema()
    {
        seo()->addFromArray([
            'title' => 'Foo',
        ]);

        $this->assertCount(1, seo()->getStructs());

        $this->assertInstanceOf(Title::class, $title = seo()->getStruct(Title::class));
        $this->assertEquals('Foo', (string) $title->getBody());
    }

    public function testAddingMultipleSingleSchemas()
    {
        seo()->addFromArray([
            'title' => 'Foo',
            'description' => 'Bar',
        ]);

        $this->assertCount(2, seo()->getStructs());

        $this->assertInstanceOf(Title::class, $title = seo()->getStruct(Title::class));
        $this->assertEquals('Foo', (string) $title->getBody());

        $this->assertInstanceOf(Description::class, $description = seo()->getStruct(Description::class));
        $this->assertEquals('Bar', (string) $description->getComputedAttribute('content'));
    }

    public function testAddingNestedSchema()
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

    public function testAddingMultipleNestedSchemas()
    {
        seo()->addFromArray([
            'twitter' => [
                'card' => 'summary',
            ],
            'og' => [
                'locale' => 'de',
            ],
        ]);

        $this->assertCount(2, seo()->getStructs());

        $this->assertInstanceOf(Twitter::class, $twitter = seo()->getStruct(Twitter::class));
        $this->assertEquals('twitter:card', (string) $twitter->getComputedAttribute('name'));
        $this->assertEquals('summary', (string) $twitter->getComputedAttribute('content'));

        $this->assertInstanceOf(OpenGraph::class, $og = seo()->getStruct(OpenGraph::class));
        $this->assertEquals('og:locale', (string) $og->getComputedAttribute('property'));
        $this->assertEquals('de', (string) $og->getComputedAttribute('content'));
    }

    public function testAddingAttributeSchema()
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

    public function testAddingMultipleAttributeSchemas()
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
}
