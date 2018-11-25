<?php

namespace romanzipp\Seo\Test;

use Orchestra\Testbench\TestCase as BaseTestCase;
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Providers\SeoServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SeoServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Seo' => Seo::class,
        ];
    }
}
