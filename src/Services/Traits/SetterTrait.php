<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Struct;
use romanzipp\Seo\Structs\Title;

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
     * Removes all structs from service instance.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->setStructs([]);
    }

    /**
     * Add title.
     *
     * @param  string|null $title
     * @return self
     */
    public function title(string $title = null): self
    {
        return $this->add(
            Title::make()->body($title)
        );
    }

    /**
     * Add Twitter struct.
     *
     * @param  string     $name
     * @param  mixed|null $content
     * @return self
     */
    public function twitter(string $name, $content = null): self
    {
        return $this->add(
            Twitter::make()->name($name)->content($content)
        );
    }

    /**
     * Add OpenGraph struct.
     *
     * @param  string     $property
     * @param  mixed|null $content
     * @return self
     */
    public function og(string $property, $content = null): self
    {
        return $this->add(
            OpenGraph::make()->property($property)->content($content)
        );
    }

    abstract public function getStructs(): array;

    abstract public function setStructs(array $structs): array;

    abstract public function appendStruct(Struct $struct): void;

    abstract public function removeDuplicateStruct(Struct $struct): void;
}
