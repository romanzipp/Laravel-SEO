<?php

namespace romanzipp\Seo\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Providers\SeoServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            romanzipp\Seo\Providers\SeoServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Seo' => Seo::class,
        ];
    }
}
