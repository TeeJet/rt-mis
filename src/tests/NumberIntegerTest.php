<?php


use classes\numbers\NumberInteger;
use classes\numbers\NumberIntegerIterator;
use PHPUnit\Framework\TestCase;

class NumberIntegerTest extends TestCase
{
    public function valueProvider()
    {
        return [
            [0, 1, "0", [1 => 0]],
            [1, 1, "1", [1 => 1]],
            [1234567890, 10, "1234567890", [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 0]],
            [987654321, 9, "987654321", [1 => 9, 8, 7, 6, 5, 4, 3, 2, 1]],
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
        $number = new NumberInteger($expected);
        $this->assertSame($expected, $number->getValue());
        $this->assertSame($size, $number->getSize());
        $this->assertSame($text, $number->getTextValue());
        $this->assertEquals(new NumberIntegerIterator($number), $number->getIterator());
        $this->assertEquals($iterator, iterator_to_array($number->getIterator()));
    }

    /**
     * @throws Exception
     */
    public function testFailWhenInitValueIsIncorrect()
    {
        $max = PHP_INT_MAX;
        $min = PHP_INT_MIN;

        $this->expectExceptionMessage("Для числового формата максимальное значение составляет {$max}");
        new NumberInteger($max * 2);

        $this->expectExceptionMessage("Можно использовать только положительные числа");
        new NumberInteger(-1);

        $this->expectExceptionMessage("Можно использовать только положительные числа");
        new NumberInteger($min * 2);

        $this->expectExceptionMessage("Можно использовать только положительные числа");
        new NumberInteger($min - 1);

        $this->expectExceptionMessage("Введено число неверного типа или превышено максимальное значение");
        new NumberInteger($max + 1);

        $this->expectExceptionMessage("Введено число неверного типа или превышено максимальное значение");
        new NumberInteger("1234567890");
    }
}