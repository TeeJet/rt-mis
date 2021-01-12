<?php

namespace classes\numbers;

use Iterator;

abstract class NumberIterator implements Iterator
{
    public $number;
    public $position = 0;

    public function __construct(NumberInterface $number)
    {
        $this->number = $number;
    }
}