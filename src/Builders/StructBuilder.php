<?php

namespace romanzipp\Seo\Builders;

use Illuminate\Support\HtmlString;
use romanzipp\Seo\Structs\Struct;

class StructBuilder
{
    /**
     * Indent rendered struct.
     *
     * @var string|null
     */
    public static $indent = null;

    /**
     * Separator for rendered structs.
     *
     * @var mixed|null
     */
    public static $separator = PHP_EOL;

    /**
     * Struct object.
     *
     * @var \romanzipp\Seo\Structs\Struct
     */
    private $struct;

    /**
     * Constructor.
     *
     * @param \romanzipp\Seo\Structs\Struct $struct
     */
    public function __construct(Struct $struct)
    {
        $this->struct = $struct;
    }

    /**
     * Instantly build struct.
     *
     * @param \romanzipp\Seo\Structs\Struct $struct
     *
     * @return \Illuminate\Support\HtmlString
     */
    public static function build(Struct $struct): HtmlString
    {
        return (new self($struct))->render();
    }

    /**
     * Render element.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function render(): HtmlString
    {
        $element = '';

        if ($indent = self::$indent) {
            $element .= $indent;
        }

        $element .= "<{$this->struct->getTag()}";

        if ($attributes = $this->renderAttributes()) {
            $element .= " {$attributes}";
        }

        $body = $this->struct->getBody();

        if ($body || ! $this->struct->isVoidElement()) {
            $element .= ">{$body}</{$this->struct->getTag()}>";
        } else {
            $element .= ' />';
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

        foreach ($this->struct->getComputedAttributes() as $attribute => $attributeValue) {
            $attribute = trim($attribute);

            if (null !== $attributeValue->data()) {
                $attribute .= "=\"{$attributeValue}\"";
            }

            $attributes[] = $attribute;
        }

        return implode(' ', $attributes);
    }
}
