<?php

namespace romanzipp\Seo\Helpers;

use romanzipp\Seo\Enums\HookTarget;

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
     * Filter the structs by certain attributes and values
     *
     * @var array
     */
    protected $filterAttributes = [];

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

    public function getFilterAttributes(): array
    {
        return $this->filterAttributes;
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

    public function whereAttribute(string $attribute, $value): self
    {
        $this->filterAttributes[$attribute] = $value;

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

    /*
     *--------------------------------------------------------------------------
     * Methods
     *--------------------------------------------------------------------------
     */

    /**
     * Modify the data that will be handed over to the
     * hook callback as parameter.
     *
     * @param  mixed   $data
     * @return mixed
     */
    public function translateCallbackData($data)
    {
        switch ($this->target) {

            case HookTarget::BODY:

                return $data;

            case HookTarget::ATTRIBUTE;

                return array_values($data)[0];

            case HookTarget::ATTRIBUTES:

                return array_map(function ($value) use ($data) {

                    return $value->data();

                }, $data);
        }
    }
}
