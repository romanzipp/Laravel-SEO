<?php

namespace romanzipp\Seo\Helpers;

use romanzipp\Seo\Enums\HookTarget;
use romanzipp\Seo\Helpers\Manipulation;

class Hook
{
    protected $target;

    protected $targetValue;

    protected $callback;

    public function __construct()
    {}

    public static function make(): self
    {
        return new self;
    }

    public function onBody(): self
    {
        $this->target = HookTarget::BODY;
    }

    public function onAttributes(): self
    {
        $this->target = HookTarget::ATTRIBUTES;
    }

    public function onAttribute(string $attribute): self
    {
        $this->target = HookTarget::ATTRIBUTE;
    }

    public function callback(callable $callback): self
    {
        $this->callback = $callback;
    }
}
