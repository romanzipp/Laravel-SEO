<?php

namespace romanzipp\Seo\Builders;

use Illuminate\Support\HtmlString;
use romanzipp\Seo\Structs\Struct;

class StructBuilder
{
    /**
     * Indent rendered struct
     *
     * @var null|string
     */
    public static $indent = null;

    /**
     * Struct object
     *
     * @var Struct
     */
    private $struct;

    /**
     * Constructor
     *
     * @param string $struct
     */
    public function __construct(Struct $struct)
    {
        $this->struct = $struct;
    }

    /**
     * Instantly build struct.
     *
     * @param  Struct       $struct
     * @return HtmlString
     */
    public static function build(Struct $struct): HtmlString
    {
        return (new self($struct))->render();
    }

    /**
     * Render element.
     *
     * @return HtmlString
     */
    public function render(): HtmlString
    {
        $element = '';

        if ($indent = self::$indent) {
            $element .= $indent;
        }

        $element .= '<' . $this->struct->getTag();

        if ($attributes = $this->renderAttributes()) {
            $element .= ' ' . $attributes . ' ';
        }

        $content = $this->struct->getContent();

        if ($content || ! $this->struct->isVoidElement()) {

            $element .= '>';
            $element .= $content ?? '';
            $element .= '</' . $this->struct->getTag() . '>';

        } else {

            $element .= '/>';
        }

        return new HtmlString($element);
    }

    /**
     * Render struct attributes to string.
     *
     * @return string
     */
    private function renderAttributes(): string
    {
        $attributes = [];

        foreach ($this->struct->getAttributes() as $key => $data) {

            $attribute = $key;

            if ($value = e($data->value)) {
                $attribute .= '="' . $value . '"';
            }

            $attributes[] = $attribute;
        }

        return implode(' ', $attributes);
    }
}
