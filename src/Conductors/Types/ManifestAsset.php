<?php

namespace romanzipp\Seo\Conductors\Types;

class ManifestAsset
{
    /**
     * @var string
     */
    public $path;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $rel = 'prefetch';

    /**
     * @var string|null
     */
    public $as;

    /**
     * @var mixed
     */
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

        if (empty($extension)) {
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
