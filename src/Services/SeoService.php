<?php

namespace romanzipp\Seo\Services;

use Illuminate\Support\Traits\Macroable;
use romanzipp\Seo\Services\Traits\CollisionTrait;
use romanzipp\Seo\Services\Traits\HooksTrait;
use romanzipp\Seo\Services\Traits\RenderTrait;
use romanzipp\Seo\Services\Traits\SchemaOrgTrait;
use romanzipp\Seo\Services\Traits\SetterTrait;
use romanzipp\Seo\Services\Traits\ShorthandSetterTrait;
use romanzipp\Seo\Structs\Struct;

class SeoService
{
    use RenderTrait;
    use SetterTrait;
    use ShorthandSetterTrait;
    use CollisionTrait;
    use HooksTrait;
    use Macroable;
    use SchemaOrgTrait;

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
     * Applied schema.org schemes.
     *
     * @var array
     */
    protected $schemeOrgTypes = [];

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

    /**
     * Get Struct by class.
     *
     * @param  string                               $class
     * @return \romanzipp\Seo\Structs\Struct|null
     */
    public function getStruct(string $class)
    {
        foreach ($this->getStructs() as $struct) {

            if (get_class($struct) == $class) {
                return $struct;
            }
        }

        return null;
    }

    /**
     * Set structs.
     *
     * @param array $structs
     */
    public function setStructs(array $structs): void
    {
        $this->structs = $structs;
    }

    /**
     * Append struct.
     *
     * @param \romanzipp\Seo\Structs\Struct $struct
     */
    public function appendStruct(Struct $struct): void
    {
        $this->structs[] = $struct;
    }
}
