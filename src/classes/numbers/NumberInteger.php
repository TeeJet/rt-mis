<?php

namespace classes\numbers;

use Exception;

class NumberInteger extends Number
{
    /**
     * @inheritDoc
     */
    public function getIterator(): NumberIterator
    {
        return new NumberIntegerIterator($this);
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
     * @param int $max
     * @throws Exception
     */
    protected function guardValue(int $max = PHP_INT_MAX)
    {
        if ($this->getValue() > $max) {
            throw new Exception("Для числового формата максимальное значение составляет {$max}");
        }
        if ($this->getValue() < 0) {
            throw new Exception("Можно использовать только положительные числа");
        }
        if (!is_int($this->getValue())) {
            throw new Exception("Введено число неверного типа или превышено максимальное значение");
        }
    }
}