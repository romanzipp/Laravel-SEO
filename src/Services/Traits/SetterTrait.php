<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Structs\Struct;

trait SetterTrait
{
    /**
     * Add struct.
     *
     * @param  Struct $struct
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
     * @param  bool   $boolean
     * @param  Struct $struct
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
     * @param  array  $structs
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
     * Removes all structs from service instance.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->setStructs([]);
    }

    abstract public function getStructs(): array;

    abstract public function setStructs(array $structs): array;

    abstract public function appendStruct(Struct $struct): void;

    abstract public function removeDuplicateStruct(Struct $struct): void;
}
