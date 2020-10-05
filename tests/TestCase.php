<?php

namespace romanzipp\Seo\Test;

use Orchestra\Testbench\TestCase as BaseTestCase;
use PHPUnit\Framework\Constraint\RegularExpression;
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

    public static function assertMatchesRegularExpression(string $pattern, string $string, string $message = ''): void
    {
        static::assertThat($string, new RegularExpression($pattern), $message);
    }
}
