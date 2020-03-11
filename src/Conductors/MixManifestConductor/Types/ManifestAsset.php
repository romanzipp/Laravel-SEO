<?php

namespace romanzipp\Seo\Conductors\MixManifestConductor\Types;

class ManifestAsset
{
    public $path;

    public $url;

    public $rel = 'prefetch';

    public function __construct(string $path, string $url)
    {
        $this->path = $path;
        $this->url = $url;
    }
}
