<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Structs\Title;

trait GetterTrait
{
    /**
     * Get possible title.
     *
     * @return string|null
     */
    public function getTitleStruct()
    {
        if ($struct = $this->getStruct(Title::class)) {
            return $struct->getBody();
        }

        return null;
    }

    abstract public function getStructs(): array;

    abstract public function getStruct(string $class);
}
