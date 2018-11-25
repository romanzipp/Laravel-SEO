<?php

namespace romanzipp\Seo\Services;

use romanzipp\Seo\Services\Traits\RenderTrait;
use romanzipp\Seo\Services\Traits\SetterTrait;

class SeoService
{
    use RenderTrait;
    use SetterTrait;

    /**
     * Config
     *
     * @var array
     */
    protected $config;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->config = config('seo');
    }

    /**
     * Create service instance
     *
     * @return self
     */
    public static function make(): self
    {
        return app(self::class);
    }

    /**
     * Get config.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}
