<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Services\SeoService;
use romanzipp\Seo\Structs\Meta;

class InstantiationTest extends TestCase
{
    public function testServiceInstance()
    {
        $this->assertInstanceOf(SeoService::class, app(SeoService::class));

        $this->assertInstanceOf(SeoService::class, Seo::make());

        $this->assertInstanceOf(SeoService::class, seo());
    }

    public function testHookInstance()
    {
        $this->assertInstanceOf(Hook::class, Hook::make());
    }

    public function testStructInstance()
    {
        $this->assertInstanceOf(Meta::class, Meta::make());
    }
}
