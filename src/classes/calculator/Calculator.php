<?php

namespace classes\calculator;

use classes\numbers\NumberInterface;
use Exception;

class Calculator
{
    private $numbers = [];

    public function append(NumberInterface $number)
    {
        $this->numbers[] = $number;
    }

    public function getNumbers(): array
    {
        return $this->numbers;
    }

    public function clear()
    {
        $this->numbers = [];
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function sum(): string
    {
        $command = new SumCommand($this->numbers);
        return $command->execute();
    }
}