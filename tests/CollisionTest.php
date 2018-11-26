<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Test\TestCase;

class CollisionTest extends TestCase
{
    public function testNormalElementCollisions()
    {
        seo()->add(
            Title::make()->body('My Title')
        );

        seo()->add(
            Title::make()->body('My Second Title')
        );

        $contents = seo()->renderContentsArray();

        $this->assertCount(1, $contents);

        $this->assertEquals('<title>My Second Title</title>', $contents[0]);
    }
}
