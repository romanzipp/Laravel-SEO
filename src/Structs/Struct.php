<?php

namespace romanzipp\Seo\Structs;

abstract class Struct
{
    abstract protected function tag(): string;

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
        $struct = new static;

        static::defaults($struct);

        return $struct;
    }

    /**
     * Modify struct after creation.
     *
     * @param self $struct
     */
    public static function defaults(self $struct)
    {
        //
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
     * @param  mixed   $content
     * @param  boolean $escape    Escape content
     * @return self
     */
    public function content($content, bool $escape = false): self
    {
        if ($escape) {
            $content = e($content);
        }

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
     * Determines if struct is void element.
     *
     * @see  https://www.w3.org/TR/html/syntax.html#void-element
     *
     * @return boolean
     */
    public function isVoidElement(): bool
    {
        return in_array($this->getTag(), [
            'area',
            'base',
            'br',
            'col',
            'embed',
            'hr',
            'img',
            'input',
            'link',
            'meta',
            'param',
            'source',
            'track',
            'wbr',
        ]);
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
