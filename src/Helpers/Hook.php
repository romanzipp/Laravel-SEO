<?php

namespace romanzipp\Seo\Helpers;

use romanzipp\Seo\Enums\HookTarget;
use romanzipp\Seo\Helpers\Manipulation;

class Hook
{
    /**
     * Struct attribute to modify, defined in the
     * HookTarget Enum
     * 
     * @var int
     */
    protected $target;

    /**
     * If HookTarget::ATTRIBUTE is used as target, this defines
     * the attribute to be modified.
     * 
     * @var mixed|null
     */
    protected $targetAttribute;

    /**
     * Callback to be applied on the target
     * 
     * @var callable
     */
    protected $callback;

    /**
     * Wether the current hook callback has been executed
     * 
     * @var boolean
     */
    protected $executed = false;

    /**
     * Create new Hook instance
     * 
     * @return self
     */
    public static function make(): self
    {
        return new self;
    }

    /*
     *--------------------------------------------------------------------------
     * Getters
     *--------------------------------------------------------------------------
     */

    public function getTarget(): int
    {
        return $this->target;
    }

    public function getTargetAttribute()
    {
        return $this->targetAttribute;
    }

    public function getCallback(): callable
    {
        return $this->callback;
    }

    /*
     *--------------------------------------------------------------------------
     * Setters
     *--------------------------------------------------------------------------
     */

    public function onBody(): self
    {
        $this->target = HookTarget::BODY;

        return $this;
    }

    public function onAttributes(): self
    {
        $this->target = HookTarget::ATTRIBUTES;

        return $this;
    }

    public function onAttribute(string $attribute): self
    {
        $this->target = HookTarget::ATTRIBUTE;

        $this->targetAttribute = $attribute;

        return $this;
    }

    public function callback(callable $callback): self
    {
        $this->callback = $callback;

        return $this;
    }

    public function setExecuted(bool $status): self
    {
        $this->executed = $status;

        return $this;
    }
}
