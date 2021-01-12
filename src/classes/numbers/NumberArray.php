<?php

namespace classes\numbers;

use Exception;

class NumberArray extends Number
{
    /**
     * @inheritDoc
     */
    public function getIterator(): NumberIterator
    {
        return new NumberArrayIterator($this);
    }

    public function getSize(): int
    {
        return count($this->getValue());
    }

    public function getTextValue(): string
    {
        $value = implode('', $this->getValue());
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
        if ($this->getSize() == 0) {
            throw new Exception("Должен быть хотя бы 1 элемент массива");
        }
        foreach ($this->getIterator() as $digit) {
            if (!is_string($digit) && !is_int($digit)) {
                throw new Exception("Элементы массива должен быть строкового или числового типа");
            }
            if (strlen($digit) > 1) {
                throw new Exception("Элементы массива должны содержать только один символ");
            }
            if(preg_match("/[^0-9]/", $digit)) {
                throw new Exception("Элементы массива должны содержать только числова значения");
            }
        }
    }
}