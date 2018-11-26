<?php

namespace romanzipp\Seo\Structs\Traits;

use romanzipp\Seo\Enums\HookTarget;
use romanzipp\Seo\Helpers\Hook;

trait HookableTrait
{
    protected static $hooks = [];

    public static function hook(Hook $hooks): void
    {
        self::$hooks[] = $hook;
    }

    public function triggerHook(int $target, $data): void
    {
        $matchingHook = null;

        foreach ($this->getMatchingHooks($target) as $hook) {

            $callback = $hook->getCallback();

            $data = $callback($data);

            $this->setModifiedHookData($hook, $data);
        }
    }

    public function getMatchingHooks(int $target): array
    {
        $hooks = [];

        foreach (self::$hooks as $key => $hook) {
            
            if ($hook->getTarget() === $target) {
                
                $hooks[] = $hook;
            }
        }

        return $hooks;
    }

    public function setModifiedHookData(Hook $hook, $data): void
    {
        switch ($hook->getTarget()) {

            case HookTarget::BODY: // $data = $this->body
                $this->body = $data;
                break;
            
            case HookTarget::ATTRIBUTES: // $data = $this->attributes
                $this->attributes = $data;
                break;

            case HookTarget::ATTRIBUTE: // $data = [$key, $value]
                $this->attributes[...array_keys($data)] = ...array_values($data);
                break;
        }
    }
}
