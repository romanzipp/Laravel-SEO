<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Test\TestCase;

class AttributeSanitizationTest extends TestCase
{
    public function testNullStringAttribute()
    {
        seo()->add(
            Meta::make()->content('0')
        );

        $meta = seo()->renderContentsArray()[0];

        $this->assertEquals('<meta content="0" />', $meta);
    }

    public function testNullIntegerAttribute()
    {
        seo()->add(
            Meta::make()->content(0)
        );

        $meta = seo()->renderContentsArray()[0];

        $this->assertEquals('<meta content="0" />', $meta);
    }

    public function testEmptyStringAttribute()
    {
        seo()->add(
            Meta::make()->content('')
        );

        $meta = seo()->renderContentsArray()[0];

        $this->assertEquals('<meta content />', $meta);
    }

    public function testEmptySpaceStringAttribute()
    {
        seo()->add(
            Meta::make()->content(' ')
        );

        $meta = seo()->renderContentsArray()[0];

        $this->assertEquals('<meta content />', $meta);
    }

    public function testBooleanAttribute()
    {
        seo()->addMany([
            Meta::make()->content(false),
            Meta::make()->content(true),
        ]);

        $metaFalse = seo()->renderContentsArray()[0];
        $metaTrue = seo()->renderContentsArray()[1];

        $this->assertEquals('<meta content="0" />', $metaFalse);
        $this->assertEquals('<meta content="1" />', $metaTrue);
    }
}
