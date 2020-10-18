<?php

namespace romanzipp\Seo\Conductors\Types;

class ManifestAsset
{
    public $path;

    public $url;

    public $rel = 'prefetch';

    public $as;

    public $type;

    public function __construct(string $path, string $url)
    {
        $this->path = $path;
        $this->url = $url;
        $this->as = $this->guessResourceType($path);
    }

    private function guessResourceType(string $path): ?string
    {
        $extension = pathinfo($path, PATHINFO_EXTENSION);

        if (null === $extension) {
            return null;
        }

        switch ($extension) {
            case 'js':
                return 'script';

            case 'css':
                return 'style';

            case 'ttf':
            case 'otf':
                return 'font';

            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'webp':
                return 'image';

            case 'mp4':
                return 'video';
        }

        return null;
    }
}
