<?php

require_once 'vendor/autoload.php';

use classes\calculator\Calculator;
use classes\numbers\NumberArray;
use classes\numbers\NumberInteger;
use classes\numbers\NumberString;

try {
    $calculator = new Calculator();
    $calculator->append(new NumberString("123"));
    $calculator->append(new NumberArray([1, 2, 3]));
    $calculator->append(new NumberInteger(123));
    echo $calculator->sum() . PHP_EOL;
} catch (Exception $exception) {
    echo "Ошибка: {$exception->getMessage()}";
}
