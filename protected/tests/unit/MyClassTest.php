<?php
class MyClassTest extends CTestCase
{

    function testCalculate()
    {
        $this->assertEquals(6,MyTestClass::Calculate(2,3));
    }
    function testCalculate1()
    {
        $this->assertEquals(array(1,2),array(1,2));
    }
    function testCalculate2()
    {
        $this->assertEquals(12,MyTestClass::Calculate(3,4));
    }

}