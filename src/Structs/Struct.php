<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Helpers\AttributeValue;
use romanzipp\Seo\Helpers\Manipulation;
use romanzipp\Seo\Structs\Traits\ManipulationsTrait;

abstract class Struct
{
    use ManipulationsTrait;

    abstract protected function tag(): string;

    /**
     * Attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Struct body
     *
     * @var null|AttributeValue
     */
    protected $body = null;

    /**
     * Constructor
     */
    public function __construct()
    {
        return static::defaults($this);
    }

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
     * Get computed attributes. Converts AttributeValue
     * objects to string values.
     *
     * @return array
     */
    public function getComputedAttributes(): array
    {
        $attributes = $this->attributes;

        array_walk($attributes, function (&$value, $attribute) {
            $value = (string) $value;
        });

        return $attributes;
    }

    /**
     * Get computed single attribute.
     *
     * @param  string  $attribute
     * @return mixed
     */
    public function getComputedAttribute(string $attribute)
    {
        return $this->getComputedAttributes()[$attribute] ?? null;
    }

    /**
     * Get struct body.
     *
     * @return mixed|null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Fluid body setter.
     *
     * @param  mixed   $body
     * @param  boolean $escape Escape body
     * @return self
     */
    public function body($body, bool $escape = false): self
    {
        if ($escape) {
            $body = e($body);
        }

        $this->setBody($body);

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
     * Set body.
     *
     * @param mixed $body
     */
    protected function setBody($body): void
    {
        $this->body = new AttributeValue($body, $this, Manipulation::BODY);
    }

    /**
     * Add attribute.
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function addAttribute(string $key, $value): void
    {
        $this->attributes[$key] = new AttributeValue($value, $this, Manipulation::ATTRIBUTE);

        //$this->attributes[$key] = (object) [
        //    'value' => new AttributeValue($value, $this, Manipulation::ATTRIBUTE),
        //];
    }
}
