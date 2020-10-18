<?php

namespace romanzipp\Seo\Values;

class Value
{
    /**
     * Value object original data.
     *
     * @var mixed|null
     */
    protected $originalData;

    /**
     * Value object data.
     *
     * @var mixed|null
     */
    protected $data;

    /**
     * Constructor.
     *
     * @param mixed|null $data
     */
    public function __construct($data = null)
    {
        $this->originalData = $data;
    }

    /**
     * Get value data.
     *
     * @return mixed|null
     */
    public function data()
    {
        if (null !== $this->data) {
            return $this->data;
        }

        return $this->originalData;
    }

    /**
     * Get original value data.
     *
     * @return mixed|null
     */
    public function getOriginalData()
    {
        return $this->originalData;
    }

    /**
     * Set modified data.
     *
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * Get data string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->data();
    }
}
