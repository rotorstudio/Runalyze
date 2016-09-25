<?php

namespace Runalyze\Calculation\Math;


class DerivativeTest extends \PHPUnit_Framework_TestCase
{
    /** @expectedException \InvalidArgumentException */
    public function testEmptyArrays()
    {
        (new Derivative())->calculate([], []);
    }

    /** @expectedException \InvalidArgumentException */
    public function testWrongArraySizes()
    {
        (new Derivative())->calculate([1, 2, 3], [1, 2]);
    }

    public function testConstantFunction()
    {
        $this->assertEquals(
            [0.0, 0.0, 0.0, 0.0, 0.0],
            (new Derivative())->calculate(
                [1.2, 1.2, 1.2, 1.2, 1.2],
                [1.0, 2.0, 5.0, 7.5, 9.0]
            )
        );
    }

    public function testConstantGradient()
    {
        $this->assertEquals(
            [1.0, 1.0, 1.0, 1.0, 1.0],
            (new Derivative())->calculate(
                [1.2, 4.2, 5.6, 8.7, 9.0],
                [1.2, 4.2, 5.6, 8.7, 9.0]
            )
        );
    }

    public function testSimpleFunction()
    {
        $this->assertEquals(
            [1.0, 1.0, 2.0, 2.5, -3.0, 6.0, -4.0, 0.0, -5.0],
            (new Derivative())->calculate(
                [1, 2, 4, 9, 3, 12, 10, 10, 5],
                [0, 1, 2, 4, 6, 7.5, 8, 9, 10]
            )
        );
    }
}
