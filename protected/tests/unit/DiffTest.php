<?php
class DiffTest extends CTestCase
{

    function testOrder()
    {
        $ids = array(1,2,5,6,7);
        $keys = array(6,7,5);
        $diff = array_diff($ids,$keys);
        $this->assertEquals($diff,array(1,2));
    }


}