<?php

namespace romanzipp\Seo\Services\Traits;

use Illuminate\Support\Arr;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Meta\Description;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Struct;
use romanzipp\Seo\Structs\Title;

trait ShorthandSetterTrait
{
    /**
     * Add title.
     *
     * @param string|null $title
     * @param boolean $escape
     * @return self
     */
    public function title(string $title = null, bool $escape = true): self
    {
        $config = Arr::get($this->config, 'shorthand.title');

        $this->addIf(
            $config['tag'], Title::make()->body($title, $escape)
        );

        $this->addIf(
            $config['opengraph'], OpenGraph::make()->property('title')->content($title, $escape)
        );

        $this->addIf(
            $config['twitter'], Twitter::make()->name('title')->content($title, $escape)
        );

        return $this;
    }

    /**
     * Add description.
     *
     * @param string|null $description
     * @param boolean $escape
     * @return self
     */
    public function description(string $description = null, bool $escape = true): self
    {
        $config = Arr::get($this->config, 'shorthand.description');

        $this->addIf(
            $config['meta'], Description::make()->content($description, $escape)
        );

        $this->addIf(
            $config['opengraph'], OpenGraph::make()->property('description')->content($description, $escape)
        );

        $this->addIf(
            $config['twitter'], Twitter::make()->name('description')->content($description, $escape)
        );

        return $this;
    }

    /**
     * Add name-content Meta struct.
     *
     * @param string $name
     * @param mixed|null $content
     * @param boolean $escape
     * @return self
     */
    public function meta(string $name, $content = null, bool $escape = true): self
    {
        return $this->add(
            Meta::make()->name($name)->content($content, $escape)
        );
    }

    /**
     * Add Twitter struct.
     *
     * @param string $name
     * @param mixed|null $content
     * @param boolean $escape
     * @return self
     */
    public function twitter(string $name, $content = null, bool $escape = true): self
    {
        return $this->add(
            Twitter::make()->name($name)->content($content, $escape)
        );
    }

    /**
     * Add OpenGraph struct.
     *
     * @param string $property
     * @param mixed|null $content
     * @param boolean $escape
     * @return self
     */
    public function og(string $property, $content = null, bool $escape = true): self
    {
        return $this->add(
            OpenGraph::make()->property($property)->content($content, $escape)
        );
    }

    abstract public function add(Struct $struct): parent;

    abstract public function addIf(bool $boolean, Struct $struct): parent;
}
