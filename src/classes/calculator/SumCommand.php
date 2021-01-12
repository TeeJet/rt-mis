<?php

namespace classes\calculator;

use classes\numbers\Number;
use classes\numbers\NumberString;
use Exception;

class SumCommand implements CommandInterface
{
    private $numbers;
    private $result;

    private $tempResult = "";
    private $remains = 0;

    /**
     * SumCommand constructor.
     * @param array $numbers
     * @throws Exception
     */
    public function __construct(array $numbers)
    {
        if (!$numbers) {
            throw new Exception("Для сложения, добавьте числа");
        }
        $this->numbers = $numbers;
        $this->result = new NumberString("0");
    }

    /**
     * @return string
     * @throws Exception
     */
    public function execute(): string
    {
        foreach ($this->numbers as $number) {
            $this->add($number);
        }
        return $this->result->getTextValue();
    }

    /**
     * @param Number $number
     * @throws Exception
     */
    private function add(Number $number)
    {
        $number1 = $number->getSize() > $this->result->getSize() ? $number : $this->result;
        $number2 = $number->getSize() <= $this->result->getSize() ? $number : $this->result;
        $iterator = $number2->getIterator();
        $iterator->rewind();
        $this->tempResult = "";
        $this->remains = 0;
        foreach ($number1->getIterator() as $digit1) {
            $digit2 = $iterator->valid() ? $iterator->current() : 0;
            $this->operateDigits($digit1, $digit2);
            $iterator->next();
        }
        $this->tempResult .= $this->remains > 0 ? $this->remains : '';
        $this->result->setValue(strrev($this->tempResult));
    }

    private function operateDigits($digit1, $digit2)
    {
        $digit = $this->sumDigits((int)$digit1, (int)$digit2, $this->remains);
        $this->tempResult .= $digit % 10;
        $this->remains = intdiv($digit, 10);
    }

    private function sumDigits(...$digits): int
    {
        return array_sum($digits);
    }
}