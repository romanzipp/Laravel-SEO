<?php

namespace romanzipp\Seo\Builders;

class ElementBuilder
{
    /**
     * Element tag
     *
     * @var string
     */
    private $tag;

    /**
     * Element attributes
     *
     * @var array
     */
    private $attributes = [];

    /**
     * Element content
     *
     * @var null|mixed
     */
    private $content = null;

    /**
     * Escape content
     *
     * @var boolean
     */
    private $escapeContent = true;

    /**
     * Constructor
     *
     * @param string $tag Element tag
     */
    public function __construct(string $tag = 'meta')
    {
        $this->tag = $tag;
    }

    /**
     * Set element content.
     *
     * @param mixed   $content
     * @param boolean $escape
     */
    public function setContent($content, bool $escape = true): self
    {
        $this->content = $content;
        $this->escapeContent = $escape;

        return $this;
    }

    /**
     * Set element attributes.
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Add attribute.
     *
     * @param string  $key
     * @param mixed   $value
     * @param boolean $escape
     */
    public function addAttribute(string $key, $value, bool $escape = true): self
    {
        $this->attributes[$key] = (object) [
            'escape' => $escape,
            'value'  => $value,
        ];

        return $this;
    }

    /**
     * Render element attributes to string.
     *
     * @return string
     */
    private function renderAttributes(): string
    {
        $attributes = [];

        foreach ($this->attributes as $key => $data) {

            $value = $data->value;

            if ($data->escape) {
                $value = e($value);
            }

            $attributes[] = $key . '="' . $value . '"';
        }

        return implode(' ', $attributes);
    }
}
