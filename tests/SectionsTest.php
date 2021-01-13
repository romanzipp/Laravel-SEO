<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Services\SeoService;
use romanzipp\Seo\Structs\Meta;
use Spatie\SchemaOrg\NightClub;
use Spatie\SchemaOrg\PetStore;

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

    public function testSectionPassedAsParameterToHelper()
    {
        seo('secondary')->twitter('card', 'default');

        self::assertSame(
            seo()->section('secondary')->getStructs(),
            seo('secondary')->getStructs()
        );
    }

    public function testSectionSetterOnMutableInstance()
    {
        $seo = app(SeoService::class);

        $seo->section('secondary');

        $seo->twitter('card', 'default');
        $seo->twitter('author', 'Roman');

        self::assertCount(2, $seo->getStructs());

        self::assertSame(
            $seo->getStructs(),
            seo('secondary')->getStructs()
        );
    }

    public function testSectionRender()
    {
        seo()->twitter('card', 'default');

        seo()->section('secondary')->twitter('card', 'secondary');

        self::assertEquals(
            '<meta name="twitter:card" content="default" />',
            seo()->render()->toHtml()
        );

        self::assertEquals(
            '<meta name="twitter:card" content="secondary" />',
            seo()->section('secondary')->render()->toHtml()
        );

        self::assertEquals(
            '<meta name="twitter:card" content="secondary" />',
            seo('secondary')->render()->toHtml()
        );
    }

    public function testSchemes()
    {
        seo()->addSchema(new NightClub());
        seo('secondary')->addSchema(new PetStore());

        self::assertCount(1, seo()->getSchemes());
        self::assertInstanceOf(NightClub::class, seo()->getSchemes()[0]);

        self::assertCount(1, seo('secondary')->getSchemes());
        self::assertInstanceOf(PetStore::class, seo('secondary')->getSchemes()[0]);
    }
}
