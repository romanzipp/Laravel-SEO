<?php

namespace romanzipp\Seo\Structs;

use romanzipp\Seo\Enums\HookTarget;
use romanzipp\Seo\Structs\Traits\HookableTrait;
use romanzipp\Seo\Values\Attribute;
use romanzipp\Seo\Values\Body;

abstract class Struct
{
    use HookableTrait;

    /**
     * Can the website <head> contain more
     * than one element of this type.
     *
     * @var bool
     */
    protected $unique = false;

    /**
     * Attribute names which should be unique across
     * all existing elements combined with the struct tag.
     *
     * @var array
     */
    protected $uniqueAttributes = [];

    /**
     * Attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Struct body.
     *
     * @var \romanzipp\Seo\Values\Body|null
     */
    protected $body = null;

    /**
     * Constructor.
     */
    public function __construct()
    {
        static::defaults($this);
    }

    /**
     * Create struct instance.
     *
     * @return self
     */
    public static function make(): self
    {
        return new static();
    }

    /**
     * Modify struct after creation.
     *
     * @param self $struct
     */
    public static function defaults(self $struct): void
    {
    }

    /*
     *--------------------------------------------------------------------------
     * Getters
     *--------------------------------------------------------------------------
     */

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
     * Get struct body.
     *
     * @return \romanzipp\Seo\Values\Body|null
     */
    public function getBody(): ?Body
    {
        return $this->body;
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
     * Get computed attributes. Converts
     * objects to string values.
     *
     * @return array
     */
    public function getComputedAttributes(): array
    {
        return $this->getAttributes();
    }

    /**
     * Get computed single attribute.
     *
     * @param string $attribute
     *
     * @return mixed
     */
    public function getComputedAttribute(string $attribute)
    {
        return $this->getComputedAttributes()[$attribute] ?? null;
    }

    /**
     * Get struct unique attributes for collision detection.
     *
     * @return array
     */
    public function getUniqueAttributes(): array
    {
        return $this->uniqueAttributes;
    }

    /**
     * Get all attributes with values that have been declared as unique.
     *
     * @return array
     */
    public function getComputedUniqueAttributes(): array
    {
        return array_filter($this->getAttributes(), function ($value, $key) {
            return in_array($key, $this->getUniqueAttributes(), false);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Is struct unique.
     *
     * @return bool
     */
    public function isUnique(): bool
    {
        return $this->unique;
    }

    /**
     * Set the unique-flag.
     *
     * @param bool $unique
     *
     * @return self
     */
    public function setUnique(bool $unique = true): Struct
    {
        $this->unique = $unique;

        return $this;
    }

    /**
     * Determines if struct is void element.
     *
     * @see  https://www.w3.org/TR/html/syntax.html#void-elements
     *
     * @return bool
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

    /*
     *--------------------------------------------------------------------------
     * Setters
     *--------------------------------------------------------------------------
     */

    /**
     * Fluid body setter.
     *
     * @param mixed $body
     * @param bool $escape Escape body
     *
     * @return self
     */
    public function body($body, bool $escape = true): Struct
    {
        if ($escape) {
            $body = $this->escapeValue($body);
        }

        $this->setBody($body);

        return $this;
    }

    /**
     * Fluid attributes setter.
     *
     * @param string $attribute
     * @param mixed|null $value
     * @param bool $escape
     *
     * @return self
     */
    public function attr(string $attribute, $value = null, bool $escape = true): Struct
    {
        $this->addAttribute($attribute, $value, $escape);

        return $this;
    }

    /**
     * Fluid setter for multiple attributes.
     *
     * @param array $attributes
     * @param bool $escape
     *
     * @return $this
     */
    public function attrs(array $attributes, bool $escape = true): Struct
    {
        foreach ($attributes as $attribute => $value) {
            $this->attr($attribute, $value, $escape);
        }

        return $this;
    }

    /**
     * Set body.
     *
     * @param mixed $body
     */
    protected function setBody($body): void
    {
        $this->body = new Body($body);

        $this->triggerHook(HookTarget::BODY, $this->body);
    }

    /**
     * Add attribute.
     *
     * @param string $key
     * @param mixed $value
     * @param bool $escape
     */
    protected function addAttribute(string $key, $value, bool $escape = true): void
    {
        if ($escape) {
            $value = $this->escapeValue($value);
        }

        $this->attributes[$key] = new Attribute($value);

        $this->triggerHook(HookTarget::ATTRIBUTE, [$key => $this->attributes[$key]]);

        $this->triggerHook(HookTarget::ATTRIBUTES, $this->attributes);
    }

    /**
     * Set attributes.
     *
     * @param array $attributes
     */
    protected function setAttributes(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            $this->addAttribute($key, $value);
        }
    }

    /**
     * Escape attribute value.
     *
     * @param mixed $value
     *
     * @return string|null
     */
    protected function escapeValue($value): ?string
    {
        switch (gettype($value)) {
            case 'NULL':

                return null;

            case 'integer':

                return (string) $value;

            case 'boolean':

                return true === $value ? '1' : '0';
        }

        $value = trim($value);

        if ('' === $value) {
            return null;
        }

        return e($value);
    }

    abstract protected function tag(): string;
}
