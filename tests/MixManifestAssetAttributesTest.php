<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Conductors\Types\ManifestAsset;

class MixManifestAssetAttributesTest extends TestCase
{
    public function testGuessScriptType()
    {
        $this->assertEquals('script', (new ManifestAsset('/js/app.js', '/js/app.123456.js'))->as);
        $this->assertEquals('script', (new ManifestAsset('/js/app.js', '/js/app.js?id=123456'))->as);
    }

    public function testGuessStyleType()
    {
        $this->assertEquals('style', (new ManifestAsset('/js/app.css', '/js/app.123456.css'))->as);
        $this->assertEquals('style', (new ManifestAsset('/js/app.css', '/js/app.css?id=123456'))->as);
    }

    public function testGuessFontType()
    {
        $this->assertEquals('font', (new ManifestAsset('/fonts/Comic-Sans.otf', '/fonts/Comic-Sans.123456.otf'))->as);
        $this->assertEquals('font', (new ManifestAsset('/fonts/Comic-Sans.otf', '/fonts/Comic-Sans.otf?id=123456'))->as);

        $this->assertEquals('font', (new ManifestAsset('/fonts/Comic-Sans.ttf', '/fonts/Comic-Sans.123456.ttf'))->as);
        $this->assertEquals('font', (new ManifestAsset('/fonts/Comic-Sans.ttf', '/fonts/Comic-Sans.ttf?id=123456'))->as);
    }

    public function testUnsupportedExtension()
    {
        $this->assertNull((new ManifestAsset('/totally-not-a-virus/app.exe', '/totally-not-a-virus/app.123456.exe'))->as);
        $this->assertNull((new ManifestAsset('/totally-not-a-virus/app.exe', '/totally-not-a-virus/app.exe?id=123456'))->as);
    }

    public function testInvalidExtension()
    {
        $this->assertNull((new ManifestAsset('/totally-not-a-virus/app', '/totally-not-a-virus/app'))->as);
    }
}
