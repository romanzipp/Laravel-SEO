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
}
