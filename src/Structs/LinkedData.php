<?php

namespace romanzipp\Seo\Structs;

class LinkedData extends Struct
{
    public static function defaults(Struct $struct): void
    {
        $struct->attr('type', 'application/ld+json');
    }

    protected function tag(): string
    {
        return 'script';
    }

    /**
     * @param array<string, array|string> $structuredData
     * @param bool $pretty
     *
     * @return $this
     */
    public function data(array $structuredData, bool $pretty = false): self
    {
        $this->body(
            json_encode($structuredData, ($pretty ? JSON_PRETTY_PRINT : 0) | JSON_UNESCAPED_SLASHES),
            false
        );

        return $this;
    }
}
