<?php

namespace romanzipp\Seo\Test;

use Orchestra\Testbench\TestCase as BaseTestCase;
use PHPUnit\Framework\Constraint\RegularExpression;
use romanzipp\Seo\Builders\StructBuilder;
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Providers\SeoServiceProvider;

abstract class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        StructBuilder::$separator = PHP_EOL;
        StructBuilder::$indent = null;
    }

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

    public static function assertMatchesRegularExpressionCustom(string $pattern, string $string, string $message = ''): void
    {
        // If parent has method assertMatchesRegularExpression, call it
        if (method_exists(BaseTestCase::class, 'assertMatchesRegularExpression')) {
            parent::assertMatchesRegularExpression($pattern, $string, $message);

            return;
        }

        static::assertThat($string, new RegularExpression($pattern), $message);
    }
}
