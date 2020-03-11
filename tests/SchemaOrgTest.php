<?php

namespace romanzipp\Seo\Test;

use Spatie\SchemaOrg\BreadcrumbList;
use Spatie\SchemaOrg\Schema;

class SchemaOrgTest extends TestCase
{
    public function testAppending()
    {
        seo()->addSchema(
            Schema::localBusiness()->name('Spatie')
        );

        $this->assertCount(
            1,
            seo()->render()->toArray()
        );
    }

    public function testSetter()
    {
        seo()->addSchema(
            Schema::localBusiness()->name('Spatie')
        );

        seo()->setSchemes([
            Schema::airline()->name('Spatie'),
        ]);

        $this->assertCount(
            1,
            seo()->render()->toArray()
        );
    }

    public function testBasicRender()
    {
        seo()->addSchema(
            Schema::localBusiness()->name('Spatie')
        );

        $this->assertStringStartsWith(
            '<script type="application/ld+json">',
            seo()->render()->toHtml()
        );
    }

    public function testBreadcrumbs()
    {
        seo()->addSchemaBreadcrumbs([
            ['name' => 'First', 'item' => 'https://example.com/first'],
            ['name' => 'Second', 'item' => 'https://example.com/second'],
        ]);

        $breadcrumbList = seo()->getSchemes()[0];

        $this->assertInstanceOf(BreadcrumbList::class, $breadcrumbList);

        $itemListElement = $breadcrumbList->getProperty('itemListElement');

        $this->assertTrue(
            is_array($itemListElement)
        );

        $this->assertCount(2, $itemListElement);

        $this->assertEquals(
            1,
            $itemListElement[0]->getProperty('position')
        );

        $this->assertEquals(
            'First',
            $itemListElement[0]->getProperty('name')
        );
    }
}
