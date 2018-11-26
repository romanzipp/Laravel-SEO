<?php

namespace romanzipp\Seo\Helpers;

use romanzipp\Seo\Enums\HookTarget;
use romanzipp\Seo\Helpers\Manipulation;

class Hook
{
    protected $target;

    protected $targetAttribute;

    protected $callback;

    protected $executed = false;

    public function __construct()
    {}

    public static function make(): self
    {
        return new self;
    }

    /// getters

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

    /// setters

    public function onBody(): self
    {
        $this->target = HookTarget::BODY;
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
