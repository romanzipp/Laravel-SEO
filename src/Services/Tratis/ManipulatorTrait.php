<?php

namespace romanzipp\Seo\Services\Traits;

use romanzipp\Seo\Helpers\Manipulation;

trait ManipulatorTrait
{
    /**
     * Registered manipulations.
     *
     * @var array
     */
    protected $manipulations = [];

    /**
     * Get manipulations.
     *
     * @return array
     */
    public function getManipulations(): array
    {
        return $this->manipulations;
    }

    /**
     * Add manipulation for struct body.
     *
     * @param  string   $structClass
     * @param  callable $callback
     * @return void
     */
    public function manipulateBody(string $structClass, callable $callback): void
    {
        $manipulation = new Manipulation;

        $manipulation->setContext(Manipulation::BODY);

        $manipulation->setClass($structClass);
        $manipulation->setCallback($callback);

        $this->manipulations[] = $manipulation;
    }

    /**
     * Add manipulation for struct attributes.
     *
     * @param  string   $structClass Strcut to apply manipulation on
     * @param  array    $attributes  Attribute + Value to find for struct
     * @param  callable $callback
     * @return void
     */
    public function manipulateAttributes(string $structClass, array $attributes, callable $callback): void
    {
        $manipulation = new Manipulation;

        $manipulation->setContext(Manipulation::ATTRIBUTE);

        $manipulation->setClass($structClass);
        $manipulation->setCallback($callback);

        $manipulation->setSearchAttribute($attribute, $attributeValue);

        $this->manipulations[] = $manipulation;
    }
}
