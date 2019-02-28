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
        $structs = $this->getStructs();

        $contents = array_map(function ($struct) {
            return StructBuilder::build($struct)->toHtml();
        }, $structs);

        return array_values($contents);
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
