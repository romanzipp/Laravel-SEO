<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Conductors\FetchesMixManifest;
use romanzipp\Seo\Exceptions\ManifestNotFoundException;
use romanzipp\Seo\Structs\Link;

class MixManifestTest extends TestCase
{
    public function testInstance()
    {
        $mix = seo()->mix();

        $this->assertInstanceOf(FetchesMixManifest::class, $mix);
    }

    public function testSetters()
    {
        $mix = seo()->mix();

        $this->assertEquals('prefetch', $mix->getRel());

        $mix->rel('preload');

        $this->assertEquals('preload', $mix->getRel());
    }

    public function testSuccessfulLoading()
    {
        $path = __DIR__ . '/Support/mix-manifest.json';

        $mix = seo()
            ->mix()
            ->load($path);

        $assets = json_decode(
            file_get_contents($path), true
        );

        $this->assertEquals($assets, $mix->getAssets());
    }

    public function testLoadingInvalidPath()
    {
        $this->expectException(ManifestNotFoundException::class);

        $path = __DIR__ . '/Support/mix-manifest.not-found.json';

        seo()
            ->mix()
            ->load($path);
    }

    public function testLoadingInvalidJson()
    {
        $path = __DIR__ . '/Support/mix-manifest.empty.json';

        $mix = seo()
            ->mix()
            ->load($path);

        $this->assertEquals([], $mix->getAssets());
    }

    public function testLoadingEmptyFile()
    {
        $path = __DIR__ . '/Support/mix-manifest.empty.json';

        $mix = seo()
            ->mix()
            ->load($path);

        $this->assertEquals([], $mix->getAssets());
    }

    public function testRejectCallback()
    {
        $path = __DIR__ . '/Support/mix-manifest.json';

        $mix = seo()
            ->mix()
            ->reject(function ($path) {
                return $path === '/css/app.css';
            })
            ->load($path);

        $assets = json_decode(
            file_get_contents($path), true
        );

        $expect = [array_keys($assets)[0] => array_values($assets)[0]];

        $this->assertEquals($expect, $mix->getAssets());
    }

    public function testFilterCallback()
    {
        $path = __DIR__ . '/Support/mix-manifest.json';

        $mix = seo()
            ->mix()
            ->filter(function ($path) {
                return $path === '/css/app.css';
            })
            ->load($path);

        $assets = json_decode(
            file_get_contents($path), true
        );

        $expect = [array_keys($assets)[1] => array_values($assets)[1]];

        $this->assertEquals($expect, $mix->getAssets());
    }

    public function testBasicStructs()
    {
        $path = __DIR__ . '/Support/mix-manifest.json';

        $mix = seo()
            ->mix()
            ->load($path);

        $this->assertCount(2, seo()->getStructs());

        $this->assertInstanceOf(Link::class, seo()->getStructs()[0]);
        $this->assertInstanceOf(Link::class, seo()->getStructs()[1]);
    }
}
