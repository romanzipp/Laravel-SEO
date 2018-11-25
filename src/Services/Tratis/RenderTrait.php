<?php

namespace romanzipp\Seo\Services\Traits;

use Illuminate\Support\HtmlString;
use romanzipp\Seo\Builders\StructBuilder;

trait RenderTrait
{
    /**
     * Render all applied structs.
     *
     * @return HtmlString
     */
    public function render(): HtmlString
    {
        $structs = $this->structs;

        $contents = array_map(function ($struct) {
            return StructBuilder::build($struct)->toHtml();
        }, $structs);

        return new HtmlString(implode(PHP_EOL, $contents));
    }
}
