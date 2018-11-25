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
     * Constructor
     *
     * @param string $tag Element tag
     */
    public function __construct(string $tag = 'meta')
    {
        $this->tag = $tag;
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
}
