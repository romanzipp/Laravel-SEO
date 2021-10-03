<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Structs\Struct;

trait CollisionTrait
{
    abstract public function getStructs(): array;

    abstract public function unsetStruct(int $index): void;

    /**
     * Remove struct from existing structs.
     *
     * @param \romanzipp\Seo\Structs\Struct $struct
     *
     * @return void
     */
    public function removeDuplicateStruct(Struct $struct): void
    {
        if ( ! $result = $this->getDuplicateStruct($struct)) {
            return;
        }

        [$existing, $key] = $result;

        if (null === $existing || null === $key) {
            return;
        }

        $this->unsetStruct($key);
    }

    /**
     * Get matching struct duplicate.
     *
     * @param \romanzipp\Seo\Structs\Struct $struct
     *
     * @return (\romanzipp\Seo\Structs\Struct|int|null)[]|null
     */
    public function getDuplicateStruct(Struct $struct): ?array
    {
        if (false === $struct->isUnique()) {
            return null;
        }

        foreach ($this->getStructs() as $key => $existing) {
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
