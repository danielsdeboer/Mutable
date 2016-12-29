<?php

use Aviator\Mutable\Exceptions\TypeException;
use Aviator\Mutable\Traits\HandlesUnknownTypes;
use Aviator\Mutable\Types\Arr;
use Aviator\Mutable\Types\Flt;
use Aviator\Mutable\Types\Int;
use Aviator\Mutable\Types\Str;

class HandlesUnknownTypesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group unknownTypes
     * @test
     */
    public function calling_unknown_type_will_return_an_instance_of_the_proper_type()
    {
        $mock = $this->getMockForTrait(HandlesUnknownTypes::class);

        $type = $mock->unknownType(2);

        $this->assertInstanceOf(Int::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_an_unhandled_type_throws_a_type_exception()
    {
        $mock = $this->getMockForTrait(HandlesUnknownTypes::class);

        try {
            $type = $mock->unknownType(true);
        } catch (TypeException $e) {
            return;
        }

        $this->fail('The test should have thrown a TypeException.');
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function providing_a_string_will_return_an_instance_of_str()
    {
        $mock = $this->getMockForTrait(HandlesUnknownTypes::class);

        $type = $mock->unknownType('string');

        $this->assertInstanceOf(Str::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function providing_a_float_will_return_an_instance_of_flt()
    {
        $mock = $this->getMockForTrait(HandlesUnknownTypes::class);

        $type = $mock->unknownType(1.222);

        $this->assertInstanceOf(Flt::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function providing_an_integer_will_return_an_instance_of_int()
    {
        $mock = $this->getMockForTrait(HandlesUnknownTypes::class);

        $type = $mock->unknownType(1222);

        $this->assertInstanceOf(Int::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function providing_an_array_will_return_an_instance_of_arr()
    {
        $mock = $this->getMockForTrait(HandlesUnknownTypes::class);

        $type = $mock->unknownType([1,2]);

        $this->assertInstanceOf(Arr::class, $type);
    }
}