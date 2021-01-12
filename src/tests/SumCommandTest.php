<?php


use classes\numbers\NumberArray;
use classes\numbers\NumberInteger;
use classes\numbers\NumberString;
use classes\calculator\SumCommand;
use PHPUnit\Framework\TestCase;

class SumCommandTest extends TestCase
{
    /**
     * @return array
     * @throws Exception
     */
    public function valueProvider()
    {
        $number1 = new NumberString("0");
        $number2 = new NumberString("1");
        $number3 = new NumberString("9");
        $number4 = new NumberString("100000000000000000000000000000000000000000000000");
        $number5 = new NumberString("999999999999999999999999999999999999999999999999");
        $number6 = new NumberInteger(10000000000000);
        $number7 = new NumberArray([1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]);
        $number8 = new NumberString("10000000000000");

        return [
            [[$number1], "0"],
            [[$number1, $number1], "0"],
            [[$number1, $number2], "1"],
            [[$number2, $number3], "10"],
            [[$number3, $number4], "100000000000000000000000000000000000000000000009"],
            [[$number4, $number5], "1099999999999999999999999999999999999999999999999"],
            [[$number5, $number4], "1099999999999999999999999999999999999999999999999"],
            [[$number2, $number5], "1000000000000000000000000000000000000000000000000"],
            [[$number5, $number2], "1000000000000000000000000000000000000000000000000"],
            [[$number1, $number2, $number3], "10"],
            [[$number4, $number4, $number4, $number4], "400000000000000000000000000000000000000000000000"],
            [[$number6, $number7], "20000000000000"],
            [[$number6, $number8], "20000000000000"],
            [[$number7, $number8], "20000000000000"],
            [[$number6, $number7, $number8], "30000000000000"],
        ];
    }

    /**
     * @dataProvider valueProvider
     * @param $numbers
     * @param $excepted
     * @throws Exception
     */
    public function testExecute($numbers, $excepted)
    {
        $command = new SumCommand($numbers);
        $this->assertSame($excepted, $command->execute());
    }

    /**
     * @throws Exception
     */
    public function testFailWhenSumEmpty()
    {
        $this->expectExceptionMessage("Для сложения, добавьте числа");
        new SumCommand([]);
    }
}