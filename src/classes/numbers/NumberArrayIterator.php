<?php

namespace classes\numbers;

class NumberArrayIterator extends NumberIterator
{
    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->number->getValue()[$this->position];
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->position--;
    }

    /**
     * @inheritDoc
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->position >= 0 && isset($this->number->getValue()[$this->position]);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = count($this->number->getValue()) - 1;
    }
}