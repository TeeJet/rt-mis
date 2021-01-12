<?php


use classes\calculator\Calculator;
use classes\numbers\NumberArray;
use classes\numbers\NumberInteger;
use classes\numbers\NumberString;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testEmpty()
    {
        $calculator = new Calculator();
        $this->assertEmpty($calculator->getNumbers());

        return $calculator;
    }

    /**
     * @param Calculator $calculator
     * @throws Exception
     * @depends testEmpty
     */
    public function testAppendAndClear(Calculator $calculator)
    {
        $number1 = new NumberString("123");
        $number2 = new NumberInteger(456);
        $number3 = new NumberArray(['7', '8', '9']);

        $calculator->append($number1);
        $this->assertSame([$number1], $calculator->getNumbers());

        $calculator->append($number2);
        $this->assertSame([$number1, $number2], $calculator->getNumbers());

        $calculator->append($number3);
        $this->assertSame([$number1, $number2, $number3], $calculator->getNumbers());

        $calculator->clear();
        $this->assertEmpty($calculator->getNumbers());
    }

    /**
     * @depends testEmpty
     * @param Calculator $calculator
     */
    public function testFailWhenAppendIsIncorrect(Calculator $calculator)
    {
        $this->expectException(TypeError::class);
        $calculator->append(123);
    }

    /**
     * @param Calculator $calculator
     * @throws Exception
     * @depends testEmpty
     */
    public function testSum(Calculator $calculator)
    {
        $number1 = new NumberString("1000000000000000000000000000000000000");
        $number2 = new NumberString("2000000000000000000000000000000000000");
        $number3 = new NumberString("7000000000000000000000000000000000000");
        $calculator->append($number1);
        $calculator->append($number2);
        $calculator->append($number3);
        $this->assertSame("10000000000000000000000000000000000000", $calculator->sum());
    }
}