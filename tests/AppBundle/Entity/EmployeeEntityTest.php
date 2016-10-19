<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Employee;

class EmployeeEntityTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider correctGenderProvider
     */
    public function testCorrectGender($gender, $expected)
    {
        $employee = new Employee();
        $employee->setGender($gender);
        $this->assertEquals($employee->getGender(), $expected);
    }

    /**
     * @dataProvider incorrectGenderProvider
     * @expectedException \InvalidArgumentException
     */
    public function testIncorrectGenderThrowsException($gender) {
        $employee = new Employee();
        $employee->setGender($gender);
    }

    public function correctGenderProvider()
    {
        return [
            ['m', 'm'],
            ['f', 'f'],
            [null, null],
        ];
    }
    public function incorrectGenderProvider()
    {
        return [
            ['Incorrect gender'],
            [123],
            [true],
            [false],
        ];
    }
}
