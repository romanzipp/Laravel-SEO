<?php

namespace romanzipp\Seo\Conductors;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\HtmlString;
use romanzipp\Seo\Builders\StructBuilder;
use Spatie\SchemaOrg\Type;

class RenderConductor implements Htmlable, Renderable, Arrayable
{
    /**
     * @var \romanzipp\Seo\Structs\Struct[]
     */
    private $structs;

    /**
     * @var \Spatie\SchemaOrg\Type[]
     */
    private $schemes;

    /**
     * RenderConductor constructor.
     *
     * @param \romanzipp\Seo\Structs\Struct[] $structs
     * @param \Spatie\SchemaOrg\Type[] $schemes
     */
    public function __construct(array $structs, array $schemes)
    {
        $this->structs = $structs;
        $this->schemes = $schemes;
    }

    /**
     * Get all structs.
     *
     * @return \romanzipp\Seo\Structs\Struct[]
     */
    public function getStructs(): array
    {
        return $this->structs;
    }

    /**
     * Get all structs.
     *
     * @return \Spatie\SchemaOrg\Type[]
     */
    public function getSchemes(): array
    {
        return $this->schemes;
    }

    /**
     * Build all applied structs.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function build(): HtmlString
    {
        $contents = $this->toArray();

        return new HtmlString(
            implode(StructBuilder::$separator, $contents)
        );
    }

    /**
     * Get array of rendered HtmlStrings.
     *
     * @return array
     */
    public function toArray(): array
    {
        $structs = array_map(static function ($struct) {
            return StructBuilder::build($struct)->toHtml();
        }, $this->getStructs());

        $schemas = array_map(static function (Type $schema) {
            return $schema->toScript();
        }, $this->getSchemes());

        return array_values(
            array_merge($structs, $schemas)
        );
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render(): string
    {
        return (string) $this->build();
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml(): string
    {
        return (string) $this->build();
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->build();
    }
}
