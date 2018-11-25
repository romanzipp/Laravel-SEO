<?php

namespace romanzipp\Seo\Structs\Traits;

use romanzipp\Seo\Helpers\Manipulation;

trait ManipulationsTrait
{
    abstract protected function getBody();

    abstract protected function getAttributes(): array;

    /**
     * Manipulations
     *
     * @var array
     */
    protected $manipulations = null;

    /**
     * Get manipulations applied on struct.
     *
     * @return array
     */
    public function getManipulations()
    {
        return $this->manipulations;
    }

    /**
     * Apply manipultion
     *
     * @param Manipulation $manipulation
     */
    public function applyManipulation(Manipulation $manipulation): void
    {
        if (get_class($this) != $manipulation->getClass()) {
            return;
        }

        $callback = $manipulation->getCallback();

        if ($manipulation->getContext() == Manipulation::BODY) {

            if ( ! $body = $this->getBody()) {
                return;
            }

            $value = $callback($body->value());

            $this->body->setValue($value);

            return;
        }

        // Context is Manipulation::ATTRIBUTE
        // At this point, we want to look for matching
        // attributes in the given manipulation.

        foreach ($this->getAttributes() as $attribute => $attributeValue) {

            if ($attribute != $manipulation->getAttribute()) {

                // We are not looking for this attribute in
                // our current manipulation.

                continue;
            }

            if ( ! $attributeValue) {

                // The current attribute matches, but we have
                // not received a valid value.

                return;
            }

            // At this point, the $attributeValue is an instance
            // of AttributeValue.

            if ($attributeValue->value() != $manipulation->getAttributeValue()) {

                // The current attribute matches, but the attribute value
                // is not what we expect.

                return;
            }

            $this->attributes = $callback(
                $this->getComputedAttributes()
            );

            return;
        }
    }
}
