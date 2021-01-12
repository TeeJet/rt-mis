<?php


use classes\numbers\NumberString;
use classes\numbers\NumberStringIterator;
use PHPUnit\Framework\TestCase;

class NumberStringTest extends TestCase
{
    public function valueProvider()
    {
        return [
            ["0", 1, "0", ['0']],
            ["1", 1, "1", ['1']],
            ["1234567890", 10, "1234567890", ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0']],
            ["0987654321", 10, "987654321", ['0', '9', '8', '7', '6', '5', '4', '3', '2', '1']],
            ["1234567890123456789012345678901234567890", 40, "1234567890123456789012345678901234567890", ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0']],
        ];
    }

    /**
     * @dataProvider valueProvider
     * @param $expected
     * @param $size
     * @param $text
     * @param $iterator
     * @throws Exception
     */
    public function testValueAndProperties($expected, $size, $text, $iterator)
    {
        $number = new NumberString($expected);
        $this->assertSame($expected, $number->getValue());
        $this->assertSame($size, $number->getSize());
        $this->assertSame($text, $number->getTextValue());
        $this->assertEquals(new NumberStringIterator($number), $number->getIterator());
        $this->assertEquals($iterator, iterator_to_array($number->getIterator()));
    }

    /**
     * @throws Exception
     */
    public function testFailWhenInitValueIsIncorrect()
    {
        $this->expectExceptionMessage("В числе задан недопустимый символ");
        new NumberString("-123");
    }
}