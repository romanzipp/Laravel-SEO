<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Conductors\MixManifestConductor;
use romanzipp\Seo\Conductors\Types\ManifestAsset;
use romanzipp\Seo\Exceptions\ManifestNotFoundException;
use romanzipp\Seo\Structs\Link;

class MixManifestTest extends TestCase
{
    public function testInstance()
    {
        $mix = seo()->mix();

        $this->assertInstanceOf(MixManifestConductor::class, $mix);
    }

    public function testLoadingOk()
    {
        $path = $this->path('mix-manifest.json');

        $mix = seo()
            ->mix()
            ->load($path);

        $assets = json_decode(
            file_get_contents($path),
            true
        );

        $this->assertEquals([
            new ManifestAsset(array_keys($assets)[0], array_values($assets)[0]),
            new ManifestAsset(array_keys($assets)[1], array_values($assets)[1]),
        ], $mix->getAssets());
    }

    public function testLoadingInvalidPath()
    {
        $this->expectException(ManifestNotFoundException::class);

        $path = $this->path('mix-manifest.not-found.json');

        seo()
            ->mix()
            ->load($path);
    }

    public function testLoadInvalidPathIgnoredException()
    {
        $path = $this->path('mix-manifest.not-found.json');

        $mix = seo()
            ->mix()
            ->ignore()
            ->load($path);

        $this->assertEquals([], $mix->getAssets());
    }

    public function testLoadingInvalidJson()
    {
        $path = $this->path('mix-manifest.empty.json');

        $mix = seo()
            ->mix()
            ->load($path);

        $this->assertEquals([], $mix->getAssets());
    }

    public function testLoadingEmptyFile()
    {
        $path = $this->path('mix-manifest.empty.json');

        $mix = seo()
            ->mix()
            ->load($path);

        $this->assertEquals([], $mix->getAssets());
    }

    public function testDefaultRel()
    {
        $path = $this->path('mix-manifest.json');

        $mix = seo()
            ->mix()
            ->load($path);

        $this->assertEquals(
            ['prefetch', 'prefetch'],
            [
                $mix->getAssets()[0]->rel,
                $mix->getAssets()[1]->rel,
            ]
        );
    }

    public function testMapCallbackNoChanges()
    {
        $path = $this->path('mix-manifest.json');

        $mix = seo()
            ->mix()
            ->map(function (ManifestAsset $asset): ?ManifestAsset {
                return $asset;
            })
            ->load($path);

        $assets = json_decode(
            file_get_contents($path),
            true
        );

        $this->assertEquals([
            new ManifestAsset(array_keys($assets)[0], array_values($assets)[0]),
            new ManifestAsset(array_keys($assets)[1], array_values($assets)[1]),
        ], $mix->getAssets());
    }

    public function testMapCallbackRejectAll()
    {
        $path = $this->path('mix-manifest.json');

        $mix = seo()
            ->mix()
            ->map(function (ManifestAsset $asset): ?ManifestAsset {
                return null;
            })
            ->load($path);

        $this->assertCount(0, $mix->getAssets());
    }

    public function testMapCallbackModifyUrl()
    {
        $path = $this->path('mix-manifest.json');

        $mix = seo()
            ->mix()
            ->map(function (ManifestAsset $asset): ?ManifestAsset {
                $asset->url = 'http://localhost' . $asset->url;

                return $asset;
            })
            ->load($path);

        $assets = json_decode(
            file_get_contents($path),
            true
        );

        $this->assertEquals(
            [
                'http://localhost' . array_values($assets)[0],
                'http://localhost' . array_values($assets)[1],
            ],
            [
                $mix->getAssets()[0]->url,
                $mix->getAssets()[1]->url,
            ]
        );
    }

    public function testMapCallbackModifyPath()
    {
        $path = $this->path('mix-manifest.json');

        $mix = seo()
            ->mix()
            ->map(function (ManifestAsset $asset): ?ManifestAsset {
                $asset->path = '/somewhere' . $asset->path;

                return $asset;
            })
            ->load($path);

        $assets = json_decode(
            file_get_contents($path),
            true
        );

        $this->assertEquals(
            [
                '/somewhere' . array_keys($assets)[0],
                '/somewhere' . array_keys($assets)[1],
            ],
            [
                $mix->getAssets()[0]->path,
                $mix->getAssets()[1]->path,
            ]
        );
    }

    public function testMapCallbackModifyRel()
    {
        $path = $this->path('mix-manifest.json');

        $mix = seo()
            ->mix()
            ->map(function (ManifestAsset $asset): ?ManifestAsset {
                $asset->rel = 'preload';

                return $asset;
            })
            ->load($path);

        $this->assertEquals(
            ['preload', 'preload'],
            [
                $mix->getAssets()[0]->rel,
                $mix->getAssets()[1]->rel,
            ]
        );
    }

    public function testBasicStructs()
    {
        $path = __DIR__ . '/Support/mix-manifest.json';

        seo()
            ->mix()
            ->load($path);

        $this->assertCount(2, seo()->getStructs());

        $this->assertInstanceOf(Link::class, seo()->getStructs()[0]);
        $this->assertInstanceOf(Link::class, seo()->getStructs()[1]);
    }

    private function path(string $file): string
    {
        return sprintf('%s/Support/%s', __DIR__, $file);
    }
}
