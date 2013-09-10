<?php

namespace Acme;

class StringCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var StringCalculator
     */
    private $calculator;

    public function setUp()
    {
            $this->calculator = new StringCalculator();
    }

    /**
     * @test
     */
    public function calculator_gets_empty_string()
    {
        $this->assertEquals(0,$this->calculator->add(""));
    }

    /**
     * @test
     */
    public function calculator_gets_a_single_string() {
        $this->assertEquals(1,$this->calculator->add('1'));
    }

    /**
     * @test
     */
    public function calculator_gets_two_strings()
    {
        $this->assertEquals(3,$this->calculator->add('1,2'));
    }

    /**
     * @test
     */
    public function calculator_gets_unknown_amount_of_numbers_in_string()
    {
        $amount = rand(1,100);
        $string = "";
        $sum = 0;
        for($i = 1; $i <= $amount; $i++) {
            $random = rand(1,100);
            $sum += $random;
            if($i == $amount) {
                $string .= $random;
            } else {
                $string .= $random.",";
            }
        }
        $this->assertEquals($sum,$this->calculator->add($string));
    }

    /**
     * @test
     */
    public function calculator_gets_line_break_in_string()
    {
        $this->assertEquals(3,$this->calculator->add("1\n2"));
    }

    /**
     * @test
     */
    public function calculator_gets_line_break_and_comma_in_string()
    {
        $this->assertEquals(6,$this->calculator->add("1,2\n3"));
    }

    /**
     * @test
     */
    public function calculator_gets_defined_delimeter_in_string()
    {
        $this->assertEquals(3,$this->calculator->add("//;\n1;2"));
    }

    /**
     * @test
     */
    public function calculator_gets_long_defined_delimiter_in_string()
    {
        $this->assertEquals(6,$this->calculator->add("//___\n1___2___3"));
    }

    /**
     * @test
     */
    public function calculator_gets_defined_delemiter_and_line_breaks_in_string()
    {
        $this->assertEquals(6,$this->calculator->add("//;\n1;2\n3"));
    }

    /**
     * @test
     */
    public function calculator_gets_negative_number()
    {
        $this->setExpectedException("InvalidArgumentException","No negative numbers allowed (-2)!");
        $this->assertEquals(4,$this->calculator->add("1,-2,3"));
    }

    /**
     * @test
     */
    public function calculator_gets_more_negative_numbers()
    {
        $this->setExpectedException("InvalidArgumentException","No negative numbers allowed (-2,-3,-4)!");
        $this->assertEquals(1,$this->calculator->add("1,-2,-3,-4"));
    }

    /**
     * @test
     */
    public function calculator_gets_defined_delimiter_and_negative_numbers()
    {
        $this->setExpectedException("InvalidArgumentException","No negative numbers allowed (-2,-3,-4)!");
        $this->assertEquals(1,$this->calculator->add("//;\n1;-2;-3;-4"));
    }
}
