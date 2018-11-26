<?php

namespace romanzipp\Seo\Services;

use romanzipp\Seo\Services\Traits\CollisionTrait;
use romanzipp\Seo\Services\Traits\HooksTrait;
use romanzipp\Seo\Services\Traits\ManipulatorTrait;
use romanzipp\Seo\Services\Traits\RenderTrait;
use romanzipp\Seo\Services\Traits\SetterTrait;

class SeoService
{
    use RenderTrait;
    use SetterTrait;
    use ManipulatorTrait;
    use CollisionTrait;
    use HooksTrait;

    /**
     * Config
     *
     * @var array
     */
    protected $config;

    /**
     * Applied structs.
     *
     * @var array
     */
    protected $structs = [];

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

    /**
     * Get structs.
     *
     * @return array
     */
    public function getStructs(): array
    {
        return $this->structs;
    }
}
