<?php

namespace romanzipp\Seo\Services\Traits;

use Illuminate\Support\HtmlString;
use romanzipp\Seo\Builders\StructBuilder;

trait RenderTrait
{
    abstract public function getStructs(): array;

    /**
     * Get array of rendered HtmlStrings.
     *
     * @return array
     */
    public function renderContentsArray(): array
    {
        $structs = $this->getStructs();

        return array_map(function ($struct) {
            return StructBuilder::build($struct)->toHtml();
        }, $structs);
    }

    /**
     * Render all applied structs.
     *
     * @return HtmlString
     */
    public function render(): HtmlString
    {
        $contents = $this->renderContentsArray();

        return new HtmlString(implode(PHP_EOL, $contents));
    }
}
