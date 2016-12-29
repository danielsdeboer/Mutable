<?php

use Aviator\Mutable\Exceptions\TypeException;
use Aviator\Mutable\Types\Int;

class IntTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @group int
     * @test
     */
    public function calling_make_with_an_int_returns_an_instance_of_int()
    {
        $int = Int::make(22);

        $this->assertInstanceOf(Int::class, $int);
    }

    /**
     * @group int
     * @test
     */
    public function calling_make_with_a_non_int_throws_a_type_exception()
    {
        try {
            $int = Int::make(1.222);

        } catch (TypeException $e) {
            return;
        }

        $this->fail();
    }

}