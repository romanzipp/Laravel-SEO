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
     * Traget class
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
     * Get callback.
     *
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
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
     * Set manipulation execution status.
     *
     * @param boolean $status
     */
    public function setExecuted(bool $status = true): void
    {
        $this->executed = $status;
    }

    /*
     *--------------------------------------------------------------------------
     * Methods
     *--------------------------------------------------------------------------
     */

    /**
     * Compare struct agains target class.
     *
     * @param  Struct    $struct
     * @return boolean
     */
    public function matches(Struct $struct): bool
    {
        return get_class($struct) == $this->class;
    }
}
