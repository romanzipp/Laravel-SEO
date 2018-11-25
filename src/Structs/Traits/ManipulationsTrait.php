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
        $this->manipulations[] = $manipulation;

        $this->guessManipulationTargets($manipulation);
    }

    private function guessManipulationTargets(Manipulation $manipulation): void
    {
        if ($manipulation->getContext() == Manipulation::BODY) {

            $body = $this->getBody();

            if ( ! $body) {
                return;
            }

            $body->executeManipulation($manipulation);
        }
    }
}
