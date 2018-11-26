<?php

namespace romanzipp\Seo\Services\Traits;

use Illuminate\Support\HtmlString;
use romanzipp\Seo\Builders\StructBuilder;

trait RenderTrait
{
    abstract public function getStructs(): array;

    /**
     * Render all applied structs.
     *
     * @return HtmlString
     */
    public function render(): HtmlString
    {
        $structs = $this->getStructs();

        $contents = array_map(function ($struct) {
            return StructBuilder::build($struct)->toHtml();
        }, $structs);

        return new HtmlString(implode(PHP_EOL, $contents));
    }
}
