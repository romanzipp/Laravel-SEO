<?php

namespace romanzipp\Seo\Helpers;

class ManipulableValue
{
    const ATTRIBUTE = 0;
    const BODY = 1;

    protected $class;

    protected $context;

    protected $value;

    public function __construct($value, $object, int $context)
    {
        $this->value = $value;
        $this->object = $object;
        $this->context = $context;
    }

    public function __toString()
    {
        return (string) $this->value;
    }

    public function value()
    {
        return $this->value;
    }
}
