<?php

namespace romanzipp\Seo\Services;

use Illuminate\Support\Traits\Macroable;
use romanzipp\Seo\Collections\SchemaCollection;
use romanzipp\Seo\Collections\StructCollection;
use romanzipp\Seo\Conductors\ArrayFormatConductor;
use romanzipp\Seo\Conductors\MixManifestConductor;
use romanzipp\Seo\Conductors\RenderConductor;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Services\Traits\CollisionTrait;
use romanzipp\Seo\Services\Traits\SchemaOrgTrait;
use romanzipp\Seo\Services\Traits\ShorthandSetterTrait;
use romanzipp\Seo\Structs\Struct;

class SeoService
{
    use CollisionTrait;
    use Macroable;
    use SchemaOrgTrait;
    use ShorthandSetterTrait;

    /**
     * Config.
     *
     * @var array<string, mixed>
     */
    protected $config;

    /**
     * The section used to add new structs and retrieve existing structs.
     * All structs for all sections will be added to the same service instance.
     *
     * @var string
     */
    protected $section = 'default';

    /**
     * Applied schema.org schemes.
     *
     * @var \romanzipp\Seo\Collections\SchemaCollection
     */
    protected $schemaCollection;

    /**
     * @var \romanzipp\Seo\Collections\StructCollection
     */
    protected $structCollection;

    /**
     * Constructor.
     *
     * @param \romanzipp\Seo\Collections\StructCollection $structCollection
     * @param \romanzipp\Seo\Collections\SchemaCollection $schemaCollection
     */
    public function __construct(StructCollection $structCollection, SchemaCollection $schemaCollection)
    {
        $this->structCollection = $structCollection;
        $this->schemaCollection = $schemaCollection;
        $this->config = config('seo');
    }

    /**
     * Create service instance.
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
     * @return array<string, mixed>
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Fluent section setter.
     *
     * @param string $section
     *
     * @return $this
     */
    public function section(string $section): self
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get structs.
     *
     * @return \romanzipp\Seo\Structs\Struct[]
     */
    public function getStructs(): array
    {
        return array_filter($this->structCollection->all(), function (Struct $struct): bool {
            return $struct->getSection() === $this->section;
        });
    }

    /**
     * Get Struct by class.
     *
     * @param string $class
     *
     * @return \romanzipp\Seo\Structs\Struct|null
     */
    public function getStruct(string $class): ?Struct
    {
        foreach ($this->getStructs() as $struct) {
            if (get_class($struct) !== $class) {
                continue;
            }

            return $struct;
        }

        return null;
    }

    /**
     * Set structs.
     *
     * @param \romanzipp\Seo\Structs\Struct[] $structCollection
     */
    public function setStructCollection(array $structCollection): void
    {
        $this->clearStructs();

        foreach ($structCollection as $struct) {
            $this->appendStruct($struct);
        }
    }

    /**
     * Remove a struct from the collection by given array index.
     *
     * @param int $index
     */
    public function unsetStruct(int $index): void
    {
        $this->structCollection->unset($index);
    }

    /**
     * Removes all structs from service instance.
     *
     * @return void
     */
    public function clearStructs(): void
    {
        $this->structCollection->set([]);
    }

    /**
     * Append a given struct. This is an internal method called by all add/set public methods
     * which also sets the current section to the struct.
     *
     * @param \romanzipp\Seo\Structs\Struct $struct
     */
    public function appendStruct(Struct $struct): void
    {
        $struct->setSection($this->section);

        $this->structCollection->add($struct);
    }

    /**
     * Add struct.
     *
     * @param Struct $struct
     *
     * @return $this
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
     *
     * @return $this
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
     * @param \romanzipp\Seo\Structs\Struct[] $structs
     *
     * @return $this
     */
    public function addMany(array $structs): self
    {
        foreach ($structs as $struct) {
            $this->add($struct);
        }

        return $this;
    }

    /**
     * Add structs from array format.
     *
     * @param array<string, mixed> $data
     *
     * @return $this
     */
    public function addFromArray(array $data): self
    {
        $this->arrayFormat()->setData($data);

        return $this;
    }

    /**
     * Add hook to given struct class. This is just an
     * alias for the Struct::hook() method.
     *
     * @param string $structClass
     * @param \romanzipp\Seo\Helpers\Hook $hook
     *
     * @return void
     */
    public function hook(string $structClass, Hook $hook): void
    {
        app($structClass)::hook($hook);
    }

    /**
     * @return \romanzipp\Seo\Conductors\MixManifestConductor
     */
    public function mix(): MixManifestConductor
    {
        return new MixManifestConductor($this);
    }

    /**
     * @return \romanzipp\Seo\Conductors\RenderConductor
     */
    public function render(): RenderConductor
    {
        return new RenderConductor(
            $this->getStructs(),
            $this->getSchemes()
        );
    }

    /**
     * @return \romanzipp\Seo\Conductors\ArrayFormatConductor
     */
    public function arrayFormat(): ArrayFormatConductor
    {
        return new ArrayFormatConductor($this);
    }
}
