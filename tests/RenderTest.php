<?php

namespace romanzipp\Seo\Test;

use Illuminate\Support\HtmlString;
use romanzipp\Seo\Builders\StructBuilder;
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Test\TestCase;

class RenderTest extends TestCase
{
    public function testRenderAll()
    {
        seo()->title('My Title');

        $this->assertInstanceOf(HtmlString::class, seo()->render());
    }

    public function testRenderSingleStruct()
    {
        $struct = Title::make()->body('My Title');

        $this->assertInstanceOf(HtmlString::class, StructBuilder::build($struct));
    }

    public function testAttributeRenderResult()
    {
        seo()->add(Title::make()->attr('attribute', 'value'));

        $this->assertEquals('<title attribute="value"></title>', seo()->render()->toHtml());
    }

    public function testSpacedAttributeRenderResult()
    {
        seo()->add(Title::make()->attr('attribute', 'value '));

        $this->assertEquals('<title attribute="value "></title>', seo()->render()->toHtml());
    }

    public function testWrongSpacedAttributeRenderResult()
    {
        seo()->add(Title::make()->attr('   attribute ', 'value'));

        $this->assertEquals('<title attribute="value"></title>', seo()->render()->toHtml());
    }

    public function testBodyRenderResult()
    {
        seo()->add(Title::make()->body('My Body'));

        $this->assertEquals('<title>My Body</title>', seo()->render()->toHtml());
    }

    public function testSpacedBodyRenderResult()
    {
        seo()->add(Title::make()->body('My Body '));

        $this->assertEquals('<title>My Body </title>', seo()->render()->toHtml());
    }
}
