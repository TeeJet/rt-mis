<?php

namespace classes\numbers;

use Exception;
use IteratorAggregate;

abstract class Number implements IteratorAggregate, NumberInterface
{
    protected $value;

    /**
     * Number constructor.
     * @param $value
     * @throws Exception
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @throws Exception
     */
    public function setValue($value)
    {
        $this->value = $value;
        $this->guardValue();
    }

    abstract public function getIterator(): NumberIterator;

    abstract public function getSize(): int;

    abstract protected function guardValue();
}