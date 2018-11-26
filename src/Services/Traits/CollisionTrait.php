<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Structs\Struct;

trait CollisionTrait
{
    /**
     * Remove struct from existing structs.
     *
     * @param  Struct $struct
     * @return void
     */
    public function removeDuplicateStruct(Struct $struct): void
    {
        if ( ! $result = $this->getDuplicateStruct($struct)) {
            return;
        }

        list($existing, $key) = $result;

        if ($existing == null || $key === null) {
            return;
        }

        unset($this->structs[$key]);
    }

    /**
     * Get matching struct duplicate
     *
     * @param  Struct       $struct
     * @return array|null
     */
    public function getDuplicateStruct(Struct $struct)
    {
        if ($struct->isUnique() == false) {
            return null;
        }

        foreach ($this->structs as $key => $existing) {

            if ($existing->getTag() !== $struct->getTag()) {
                continue;
            }

            if (empty($existing->getUniqueAttributes())) {
                return [$existing, $key];
            }
        }

        return null;
    }
}
