<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Services\SeoService;
use romanzipp\Seo\Test\TestCase;

class InstantiationTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(SeoService::class, Seo::make());

        $this->assertInstanceOf(SeoService::class, seo());
    }
}
