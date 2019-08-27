<?php

namespace romanzipp\Seo\Conductors;

use Closure;
use romanzipp\Seo\Exceptions\ManifestNotFoundException;
use romanzipp\Seo\Services\SeoService;
use romanzipp\Seo\Structs\Link;

class FetchesMixManifest
{
    /**
     * @type string
     */
    private $rel = 'prefetch';

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $assets = [];

    /**
     * @var array
     */
    private $assetCallbacks = [];

    /**
     * MixManifestService constructor.
     */
    public function __construct()
    {
        $this->path = public_path('mix-manifest.json');
    }

    /**
     * @return string
     */
    public function getRel(): string
    {
        return $this->rel;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getAssets(): array
    {
        return $this->assets;
    }

    /**
     * @param string $rel
     * @return \romanzipp\Seo\Conductors\FetchesMixManifest
     */
    public function rel(string $rel): self
    {
        $this->rel = $rel;

        return $this;
    }

    /**
     * @param \Closure $callback
     * @return \romanzipp\Seo\Conductors\FetchesMixManifest
     */
    public function reject(Closure $callback): self
    {
        $this->assetCallbacks[] = ['reject', [$callback]];

        return $this;
    }

    /**
     * @param \Closure $callback
     * @return \romanzipp\Seo\Conductors\FetchesMixManifest
     */
    public function filter(Closure $callback): self
    {
        $this->assetCallbacks[] = ['filter', [$callback]];

        return $this;
    }

    /**
     * @param string|null $path
     * @return \romanzipp\Seo\Conductors\FetchesMixManifest
     * @throws \romanzipp\Seo\Exceptions\ManifestNotFoundException
     */
    public function load(string $path = null): self
    {
        if ($path !== null) {
            $this->path = $path;
        }

        $assets = $this->readContents();

        $this->assets = $this->applyCallbacks($assets);

        $this->generateStructs();

        return $this;
    }

    /**
     * @return void
     */
    private function generateStructs(): void
    {
        $seo = app(SeoService::class);

        foreach ($this->getAssets() as $path => $url) {
            $seo->add(
                Link::make()
                    ->rel($this->getRel())
                    ->href(asset($url))
            );
        }
    }

    /**
     * @return array
     * @throws \romanzipp\Seo\Exceptions\ManifestNotFoundException
     */
    private function readContents(): array
    {
        $content = @file_get_contents($this->getPath());

        if ($content === false) {
            throw new ManifestNotFoundException;
        }

        return @json_decode($content, true);
    }

    /**
     * @param array $assets
     * @return array
     */
    private function applyCallbacks(array $assets): array
    {
        $assets = collect($assets);

        foreach ($this->assetCallbacks as $callback) {
            $assets = $assets->{$callback[0]}(...$callback[1]);
        }

        return $assets->toArray();
    }
}
