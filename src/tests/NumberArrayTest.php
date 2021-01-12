<?php


use classes\numbers\NumberArray;
use classes\numbers\NumberArrayIterator;
use PHPUnit\Framework\TestCase;

class NumberArrayTest extends TestCase
{
    public function valueProvider()
    {
        return [
            [[0], 1, "0"],
            [[1], 1, "1"],
            [[1, 2, 3, 4, 5, 6, 7, 8, 9, 0], 10, "1234567890"],
            [['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'], 10, "1234567890"],
            [['0', 9, '8', 7, '6', 5, '4', 3, '2', 1], 10, "987654321"],
            [['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'], 40, "1234567890123456789012345678901234567890"],
        ];
    }

    /**
     * @dataProvider valueProvider
     * @param $expected
     * @param $size
     * @param $text
     * @throws Exception
     */
    public function testValueAndProperties($expected, $size, $text)
    {
        $number = new NumberArray($expected);
        $this->assertSame($expected, $number->getValue());
        $this->assertSame($size, $number->getSize());
        $this->assertSame($text, $number->getTextValue());
        $this->assertEquals(new NumberArrayIterator($number), $number->getIterator());
        $this->assertEquals($expected, iterator_to_array($number->getIterator()));
    }

    /**
     * @throws Exception
     */
    public function testFailWhenInitValueIsIncorrect()
    {
        $this->expectExceptionMessage("Должен быть хотя бы 1 элемент массива");
        new NumberArray([]);

        $this->expectExceptionMessage("Элементы массива должен быть строкового или числового типа");
        new NumberArray([1, 2, []]);

        $this->expectExceptionMessage("Элементы массива должны содержать только один символ");
        new NumberArray(['1', '2', '23']);

        $this->expectExceptionMessage("Элементы массива должны содержать только числова значения");
        new NumberArray(['-', '1', '2']);
    }
}