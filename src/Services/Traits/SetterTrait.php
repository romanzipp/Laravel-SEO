<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Structs\Struct;

trait SetterTrait
{
    /**
     * Add struct.
     *
     * @param Struct $struct
     */
    public function add(Struct $struct): self
    {
        $this->removeDuplicateStruct($struct);

        $this->appendStruct($struct);

        return $this;
    }

    /**
     * Add many structs.
     *
     * @param array $structs
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
