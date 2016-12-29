<?php

use Aviator\Mutable\Exceptions\TypeException;
use Aviator\Mutable\Types\Flt;

class FltTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @group flt
     * @test
     */
    public function calling_make_with_a_float_returns_an_instance_of_flt()
    {
        $flt = Flt::make(1.111);

        $this->assertInstanceOf(Flt::class, $flt);
    }

    /**
     * @group flt
     * @test
     */
    public function calling_make_with_a_non_float_throws_a_type_exception()
    {
        try {
            $flt = Flt::make([1,2]);

        } catch (TypeException $e) {
            return;
        }

        $this->fail();
    }

}