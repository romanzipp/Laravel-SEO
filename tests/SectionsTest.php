<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Structs\Meta;

class SectionsTest extends TestCase
{
    public function testDefaultSection()
    {
        seo()->twitter('card', 'default');

        self::assertSame(
            seo()->section('default')->getStructs(),
            seo()->getStructs()
        );
    }

    public function testDefaultSectionExplicitlyDeclared()
    {
        seo()->section('default')->twitter('card', 'default');

        self::assertSame(
            seo()->section('default')->getStructs(),
            seo()->getStructs()
        );
    }

    public function testDefaultSectionUntouched()
    {
        seo()->section('secondary')->twitter('card', 'default');

        self::assertSame(
            seo()->section('default')->getStructs(),
            seo()->getStructs()
        );
    }

    public function testSectionsDoNotMatch()
    {
        seo()
            ->add(Meta::make()->attr('section', 'default'));

        seo()
            ->section('secondary')
            ->add(Meta::make()->attr('section', 'secondary'));

        self::assertCount(1, seo()->getStructs());
        self::assertSame('default', (string) seo()->getStruct(Meta::class)->getComputedAttribute('section'));

        self::assertCount(1, seo()->section('default')->getStructs());
        self::assertSame('default', (string) seo()->section('default')->getStruct(Meta::class)->getComputedAttribute('section'));

        self::assertCount(1, seo()->section('secondary')->getStructs());
        self::assertSame('secondary', (string) seo()->section('secondary')->getStruct(Meta::class)->getComputedAttribute('section'));
    }
}
