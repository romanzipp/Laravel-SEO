<?php

namespace romanzipp\Seo\Service;

use romanzipp\Seo\Service\Traits\RenderTrait;
use romanzipp\Seo\Service\Traits\SetterTrait;

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
     * Get config.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}
