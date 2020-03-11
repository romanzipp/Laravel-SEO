<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Structs\Struct;

trait CollisionTrait
{
    /**
     * Remove struct from existing structs.
     *
     * @param \romanzipp\Seo\Structs\Struct $struct
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
     * @param \romanzipp\Seo\Structs\Struct $struct
     * @return array|null
     */
    public function getDuplicateStruct(Struct $struct)
    {
        if ($struct->isUnique() === false) {
            return null;
        }

        foreach ($this->structs as $key => $existing) {

            /** @var \romanzipp\Seo\Structs\Struct $existing */

            if (get_class($existing) !== get_class($struct)) {
                continue;
            }

            if (empty($existing->getUniqueAttributes())) {
                return [$existing, $key];
            }

            $diff = array_diff(
                $existing->getComputedUniqueAttributes(),
                $struct->getComputedUniqueAttributes()
            );

            if (empty($diff)) {
                return [$existing, $key];
            }
        }

        return null;
    }
}
