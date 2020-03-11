<?php

namespace romanzipp\Seo\Services;

use Illuminate\Support\Traits\Macroable;
use romanzipp\Seo\Conductors\MixManifestConductor\MixManifestConductor;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Services\Traits\CollisionTrait;
use romanzipp\Seo\Services\Traits\RenderTrait;
use romanzipp\Seo\Services\Traits\SchemaOrgTrait;
use romanzipp\Seo\Services\Traits\ShorthandSetterTrait;
use romanzipp\Seo\Structs\Struct;

class SeoService
{
    use RenderTrait;
    use ShorthandSetterTrait;
    use CollisionTrait;
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
    protected $schemaOrgTypes = [];

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
     * @param string $class
     * @return \romanzipp\Seo\Structs\Struct|null
     */
    public function getStruct(string $class): ?Struct
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
     * Removes all structs from service instance.
     *
     * @return void
     */
    public function clearStructs(): void
    {
        $this->setStructs([]);
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

    /**
     * Add struct.
     *
     * @param Struct $struct
     * @return self
     */
    public function add(Struct $struct): self
    {
        $this->removeDuplicateStruct($struct);

        $this->appendStruct($struct);

        return $this;
    }

    /**
     * Add a given Struct if the given condition is true.
     *
     * @param bool $boolean
     * @param Struct $struct
     * @return self
     */
    public function addIf(bool $boolean, Struct $struct): self
    {
        if ($boolean) {
            $this->add($struct);
        }

        return $this;
    }

    /**
     * Add many structs.
     *
     * @param array $structs
     * @return self
     */
    public function addMany(array $structs): self
    {
        foreach ($structs as $struct) {

            $this->add($struct);
        }

        return $this;
    }

    /**
     * Add hook to given struct class. This is just an
     * alias for the Struct::hook() method.
     *
     * @param string $structClass
     * @param \romanzipp\Seo\Helpers\Hook $hook
     * @return void
     */
    public function hook(string $structClass, Hook $hook): void
    {
        app($structClass)::hook($hook);
    }

    /**
     * @return \romanzipp\Seo\Conductors\MixManifestConductor\MixManifestConductor
     */
    public function mix(): MixManifestConductor
    {
        return new MixManifestConductor;
    }
}
