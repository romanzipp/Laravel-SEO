<?php

namespace romanzipp\Seo\Conductors;

use Closure;
use romanzipp\Seo\Conductors\Types\ManifestAsset;
use romanzipp\Seo\Exceptions\ManifestNotFoundException;
use romanzipp\Seo\Services\SeoService;
use romanzipp\Seo\Structs\Link;

class MixManifestConductor
{
    /**
     * @var \romanzipp\Seo\Services\SeoService
     */
    private $seo;

    /**
     * @var string
     */
    private $path;

    /**
     * @var \romanzipp\Seo\Conductors\Types\ManifestAsset[]
     */
    private $assets = [];

    /**
     * @var \Closure|null
     */
    private $mapCallback = null;

    /**
     * @var bool
     */
    private $ignore = false;

    /**
     * MixManifestService constructor.
     */
    public function __construct(SeoService $seo)
    {
        $this->seo = $seo;
        $this->path = public_path('mix-manifest.json');
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return \romanzipp\Seo\Conductors\Types\ManifestAsset[]
     */
    public function getAssets(): array
    {
        return $this->assets;
    }

    /**
     * Add an callback function which will be applied to every asset.
     *
     * @param \Closure $callback
     *
     * @return \romanzipp\Seo\Conductors\MixManifestConductor
     */
    public function map(Closure $callback): self
    {
        $this->mapCallback = $callback;

        return $this;
    }

    /**
     * Do not throw exception of the mix manifest is not found.
     *
     * @return $this
     */
    public function ignore(): self
    {
        $this->ignore = true;

        return $this;
    }

    /**
     * @param string|null $path
     *
     * @throws \romanzipp\Seo\Exceptions\ManifestNotFoundException
     *
     * @return \romanzipp\Seo\Conductors\MixManifestConductor
     */
    public function load(string $path = null): self
    {
        if (null !== $path) {
            $this->path = $path;
        }

        $this->assets = $this->readContents();

        if (null !== $this->mapCallback) {
            $this->assets = array_map($this->mapCallback, $this->assets);
        }

        $this->assets = array_filter($this->assets);

        foreach ($this->assets as $asset) {
            $this->generateStruct($asset);
        }

        return $this;
    }

    /**
     * @param \romanzipp\Seo\Conductors\Types\ManifestAsset $asset
     *
     * @return void
     */
    private function generateStruct(ManifestAsset $asset): void
    {
        $link = Link::make()
            ->rel($asset->rel)
            ->href($asset->url);

        if (null !== $asset->as) {
            $link->as($asset->as);
        }

        if (null !== $asset->type) {
            $link->type($asset->type);
        }

        $this->seo->add($link);
    }

    /**
     * @throws \romanzipp\Seo\Exceptions\ManifestNotFoundException
     *
     * @return \romanzipp\Seo\Conductors\Types\ManifestAsset[]
     */
    private function readContents(): array
    {
        $content = @file_get_contents($this->getPath());

        if (false === $content) {
            if ($this->ignore) {
                return [];
            }

            throw new ManifestNotFoundException('The manifest file could not be found');
        }

        $data = @json_decode($content, true) ?? [];

        return array_map(static function ($path, $url) {
            return new ManifestAsset($path, $url);
        }, array_keys($data), $data);
    }
}
