<?php

namespace romanzipp\Seo\Helpers;

use romanzipp\Seo\Helpers\Manipulation;

class ManipulableValue
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
        return (string) $this->value;
    }

    public function executeManipulation(Manipulation $manipulation)
    {
        $callback = $manipulation->getCallback();

        $this->value = $callback($this->originalValue);
    }

    public function value()
    {
        if ($this->value) {
            return $this->value;
        }

        return $this->originalValue;
    }
}
