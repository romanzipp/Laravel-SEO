<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Test\TestCase;

class EscapingTest extends TestCase
{
    public function testBodyEscaping()
    {
        $malicious = '<script>alert("malicious");</script>';

        seo()->add(
            Title::make()->body($malicious)
        );

        $title = seo()->renderContentsArray()[0];

        $this->assertEquals('<title>' . e($malicious) . '</title>', $title);
    }

    public function testAttributeEscaping()
    {
        $malicious = '<script>alert("malicious");</script>';

        seo()->add(
            Meta::make()->attr('content', $malicious)
        );

        $meta = seo()->renderContentsArray()[0];

        $this->assertEquals('<meta content="' . e($malicious) . '" />', $meta);
    }

    public function testSkipEscaping()
    {
        $url = 'http://example.com/something?param1=123&param2=456';

        $expected = '<meta name="url" content="' . $url . '" />';

        seo()->add(
            Meta::make()->attr('name', 'url')->attr('content', $url, false)
        );

        $meta = seo()->renderContentsArray()[0];

        $this->assertEquals($expected, $meta);
    }
}
