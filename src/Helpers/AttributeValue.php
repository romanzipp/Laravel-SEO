<?php

namespace romanzipp\Seo\Helpers;

use romanzipp\Seo\Helpers\Manipulation;

class AttributeValue
{
    /**
     * Original calue
     *
     * @var mixed
     */
    protected $originalValue;

    /**
     * Value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Object
     *
     * @var object
     */
    protected $object;

    /**
     * Context
     *
     * @var int
     */
    protected $context;

    /**
     * Constructor.
     *
     * @param mixed  $value
     * @param object $object
     * @param int    $context
     */
    public function __construct($value, object $object, int $context)
    {
        $this->originalValue = $value;

        $this->object = $object;

        $this->context = $context;
    }

    /**
     * Get string value.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value();
    }

    /**
     * A manipulation is being applied to the current value.
     *
     * @param  Manipulation $manipulation
     * @return void
     */
    public function executeManipulation(Manipulation $manipulation): void
    {
        $callback = $manipulation->getCallback();

        $this->value = $callback($this->object);
    }

    /**
     * Set value.
     *
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * Get computed value.
     *
     * @return mixed
     */
    public function value()
    {
        if ($this->value) {
            return $this->value;
        }

        return $this->originalValue;
    }
}
