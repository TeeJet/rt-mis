<?php

namespace classes\numbers;

use DivisionByZeroError;

class NumberIntegerIterator extends NumberIterator
{
    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->getDigitByPosition();
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
        try {
            return $this->position >= 1;
        } catch (DivisionByZeroError $exception) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = strlen($this->number->getValue());
    }

    private function getDigitByPosition(): int
    {
        $temp = pow(10, $this->number->getSize() - $this->position);
        return intdiv($this->number->getValue(), $temp) % 10;
    }
}