<?php

namespace classes\numbers;

use Exception;

class NumberString extends Number
{
    /**
     * @inheritDoc
     */
    public function getIterator(): NumberIterator
    {
        return new NumberStringIterator($this);
    }

    public function getSize(): int
    {
        return strlen($this->getValue());
    }

    public function getTextValue(): string
    {
        $value = (string)$this->getValue();
        if ($this->getSize() > 1) {
            $value = ltrim($value, 0);
        }
        return $value;
    }

    /**
     * @throws Exception
     */
    protected function guardValue()
    {
        if(preg_match("/[^0-9]/", $this->getValue())) {
            throw new Exception("В числе задан недопустимый символ");
        }
    }
}