<?php

namespace romanzipp\Seo\Conductors\ArrayStructures;

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

    final public function __construct(?string $class = null)
    {
        $this->class = $class;
    }

    /**
     * Create a new array schema instance.
     *
     * @param string|null $class
     *
     * @return static
     */
    public static function make(?string $class = null)
    {
        return new static($class);
    }

    /**
     * Set the callback.
     *
     * @param \Closure $callback
     *
     * @return static
     */
    public function callback(\Closure $callback)
    {
        $this->callback = $callback;

        return $this;
    }

    /**
     * Get the callback.
     *
     * @return \Closure
     */
    public function getCallback(): \Closure
    {
        return $this->callback;
    }

    /**
     * Call the callback with given parameters.
     *
     * @param mixed[] $parameters
     */
    protected function call(array $parameters): void
    {
        call_user_func(
            $this->getCallback(),
            ...$parameters
        );
    }

    /**
     * @param mixed $data
     */
    abstract public function apply($data): void;
}
