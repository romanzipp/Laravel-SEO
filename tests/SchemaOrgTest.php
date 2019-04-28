<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Test\TestCase;
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
            seo()->renderContentsArray()
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
            seo()->renderContentsArray()
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
}
