<?php

namespace romanzipp\Seo\Builders;

class ElementBuilder
{
    /**
     * Element tag
     *
     * @var string
     */
    private $tag;

    /**
     * Constructor
     *
     * @param string $tag Element tag
     */
    public function __construct(string $tag = 'meta')
    {
        $this->tag = $tag;
    }
}
