<?php

namespace romanzipp\Seo\Conductors\ArrayStructures;

use Closure;

abstract class AbstractArraySchema
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var \Closure
     */
    protected $callback;

    public function __construct(?string $class = null)
    {
        $this->class = $class;
    }

    /**
     * @param string|null $class
     * @return static
     */
    public static function make(?string $class = null)
    {
        return new static($class);
    }

    /**
     * @param \Closure $callback
     * @return static
     */
    public function callback(Closure $callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * Get the callback.
     *
     * @return \Closure
     */
    public function getCallback(): Closure
    {
        return $this->callback;
    }

    protected function call(array $parameters)
    {
        call_user_func(
            $this->getCallback(),
            ...$parameters
        );
    }

    abstract public function acceptsSingleValue(): bool;

    abstract public function apply($data);
}
