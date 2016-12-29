<?php

use Aviator\Mutable\Exceptions\TypeException;
use Aviator\Mutable\Types\Arr;

class ArrTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @group arr
     * @test
     */
    public function calling_make_with_an_array_returns_an_instance_of_arr()
    {
        $arr = Arr::make([1,2]);

        $this->assertInstanceOf(Arr::class, $arr);
    }

    /**
     * @group arr
     * @test
     */
    public function calling_make_with_a_non_array_throws_a_type_exception()
    {
        try {
            $arr = Arr::make('string');

        } catch (TypeException $e) {
            return;
        }

        $this->fail();
    }

}