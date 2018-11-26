<?php

namespace romanzipp\Seo\Structs\Traits;

use romanzipp\Seo\Enums\HookTarget;
use romanzipp\Seo\Helpers\Hook;

trait HookableTrait
{
    /**
     * Applied hooks.
     *
     * @var array
     */
    protected static $hooks = [];

    /**
     * Add given Hook to the struct.
     * @param  Hook   $hook
     * @return void
     */
    public static function hook(Hook $hook): void
    {
        self::$hooks[] = $hook;
    }

    /**
     * Remove all hooks.
     *
     * @return void
     */
    public static function clearHooks(): void
    {
        self::$hooks = [];
    }

    /**
     * Trigger all possible hooks by given target.
     * This is getting called if struct values are changed.
     *
     * @param  int    $target
     * @param  mixed  $data
     * @return void
     */
    public function triggerHook(int $target, $data): void
    {
        foreach ($this->getMatchingHooks($target, $data) as $hook) {

            $callback = $hook->getCallback();

            // We can pass body or multiple attributes to the user callback without
            // worring about data pre-formating.
            // In case of single-attribute manipulation we only need to pass the
            // attribute value to the callback.

            $callbackData = $hook->translateCallbackData($data);

            $data = $callback($callbackData);

            $this->setModifiedHookData($hook, $data);
        }
    }

    /**
     * Get all matching hooks applied to the struct
     * given by a target.
     *
     * @param  int     $target
     * @param  mixed   $data
     * @return array
     */
    public function getMatchingHooks(int $target, $data): array
    {
        $hooks = [];

        foreach (self::$hooks as $key => $hook) {

            if ($hook->getTarget() !== $target) {
                continue;
            }

            $filterAttributes = $hook->getFilterAttributes();

            foreach ($filterAttributes as $fAttribute => $fValue) {

                if ($this->getComputedAttribute($fAttribute) != $fValue) {
                    continue (2);
                }
            }

            if ($target == HookTarget::BODY || $target == HookTarget::ATTRIBUTES) {

                $hooks[] = $hook;

                continue;
            }

            // $data = ['attribute' => 'value']

            $attribute = array_keys($data)[0];

            if ($attribute != $hook->getTargetAttribute()) {
                continue;
            }

            $hooks[] = $hook;
        }

        return $hooks;
    }

    /**
     * Set the modified struct data from hook
     * as struct value.
     *
     * @param  Hook   $hook
     * @param  mixed  $data
     * @return void
     */
    public function setModifiedHookData(Hook $hook, $data): void
    {
        switch ($hook->getTarget()) {

            case HookTarget::BODY:
                $this->body = $data;
                break;

            case HookTarget::ATTRIBUTES:
                $this->attributes = $data;
                break;

            case HookTarget::ATTRIBUTE:
                $this->attributes[$hook->getTargetAttribute()] = $data;
                break;
        }
    }

    abstract public function getComputedAttribute(string $attribute);
}
