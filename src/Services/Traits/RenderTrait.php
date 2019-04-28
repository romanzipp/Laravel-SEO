<?php

namespace romanzipp\Seo\Services\Traits;

use Illuminate\Support\HtmlString;
use romanzipp\Seo\Builders\StructBuilder;

trait RenderTrait
{
    /**
     * Get array of rendered HtmlStrings.
     *
     * @return array
     */
    public function renderContentsArray(): array
    {
        $structs = array_map(function ($struct) {
            return StructBuilder::build($struct)->toHtml();
        }, $this->getStructs());

        $schemas = array_map(function ($schema) {
            return $schema->toScript();
        }, $this->getSchemes());

        return array_values(
            array_merge($structs, $schemas)
        );
    }

    /**
     * Render all applied structs.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render(): HtmlString
    {
        $contents = $this->renderContentsArray();

        if (StructBuilder::$separator === null) {
            return implode('', $contents);
        }

        return new HtmlString(
            implode(StructBuilder::$separator, $contents)
        );
    }

    abstract public function getStructs(): array;
}
