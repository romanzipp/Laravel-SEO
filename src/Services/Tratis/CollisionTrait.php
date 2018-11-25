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
        list($existing, $key) = $this->getDuplicateStruct($struct);

        if ($existing == null || $key === null) {
            return;
        }

        unset($this->structs[$key]);
    }

    /**
     * Get matching struct duplicate
     *
     * @param  Struct        $struct
     * @return Struct|null
     */
    public function getDuplicateStruct(Struct $struct): array
    {
        if ($struct->isUnique() == false) {
            return [null, null];
        }

        return [null, null];
    }
}
