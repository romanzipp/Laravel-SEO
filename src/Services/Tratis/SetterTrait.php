<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Structs\Presets\OpenGraph;
use romanzipp\Seo\Structs\Presets\Twitter;
use romanzipp\Seo\Structs\Struct;

trait SetterTrait
{
    abstract public function getStructs(): array;

    /**
     * Add struct.
     *
     * @param Struct $struct
     */
    public function add(Struct $struct): self
    {
        $this->structs[] = $struct;

        return $this;
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
}
