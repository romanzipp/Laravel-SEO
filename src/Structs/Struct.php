<?php

namespace romanzipp\Seo\Structs;

class Struct
{
    /**
     * Attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Struct content
     *
     * @var null|mixed
     */
    protected $content = null;

    /**
     * Create struct instance.
     *
     * @return self
     */
    public static function make(): self
    {
        return new static;
    }

    /**
     * Get struct tag.
     *
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag();
    }

    /**
     * Get struct attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Get struct content.
     *
     * @return mixed|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Fluid content setter.
     *
     * @param  mixed  $content
     * @return self
     */
    public function content($content): self
    {
        $this->setContent($content);

        return $this;
    }

    /**
     * Fluid attributes setter.
     *
     * @param  string     $key
     * @param  mixed|null $value
     * @return self
     */
    public function attr(string $key, $value = null): self
    {
        $this->addAttribute($key, $value);

        return $this;
    }

    /**
     * Set content.
     *
     * @param mixed $content
     */
    protected function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * Add attribute.
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function addAttribute(string $key, $value): void
    {
        $this->attributes[$key] = (object) [
            'value' => $value,
        ];
    }
}
