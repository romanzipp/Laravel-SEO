<?php

namespace romanzipp\Seo\Helpers;

use romanzipp\Seo\Structs\Struct;

class Manipulation
{
    const ATTRIBUTE = 0;
    const BODY = 1;

    /**
     * Execution status
     *
     * @var boolean
     */
    protected $executed = false;

    /**
     * Context
     *
     * @var int
     */
    protected $context;

    /**
     * Target class
     *
     * @var int
     */
    protected $class;

    /**
     * Callback
     *
     * @var callable
     */
    protected $callback;

    /**
     * Attribute
     *
     * @var string
     */
    protected $attribute;

    /**
     * Attribute value
     *
     * @var string
     */
    protected $attributeValue;

    /*
     *--------------------------------------------------------------------------
     * Getters
     *--------------------------------------------------------------------------
     */

    /**
     * Get context.
     *
     * @return int
     */
    public function getContext(): int
    {
        return $this->context;
    }

    /**
     * Get class.
     *
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * Get callback.
     *
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }

    /**
     * Get attribute.
     *
     * @return string
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * Get attribute.
     *
     * @return string
     */
    public function getAttributeValue(): string
    {
        return $this->attributeValue;
    }

    /*
     *--------------------------------------------------------------------------
     * Setters
     *--------------------------------------------------------------------------
     */

    /**
     * Set context.
     *
     * @param  int    $context
     * @return void
     */
    public function setContext(int $context): void
    {
        $this->context = $context;
    }

    /**
     * Set struct class.
     *
     * @param  string $structClass
     * @return void
     */
    public function setClass(string $structClass): void
    {
        $this->class = $structClass;
    }

    /**
     * Set callback
     * @param  callable $callback
     * @return void
     */
    public function setCallback(callable $callback): void
    {
        $this->callback = $callback;
    }

    /**
     * Set Attribute & Value.
     *
     * @param  string $attribute
     * @param  string $attributeValue
     * @return void
     */
    public function setSearchAttribute(string $attribute, string $attributeValue): void
    {
        $this->attribute = $attribute;
        $this->attributeValue = $attributeValue;
    }

    /**
     * Set manipulation execution status.
     *
     * @param boolean $status
     */
    public function setExecuted(bool $status = true): void
    {
        $this->executed = $status;
    }
}
