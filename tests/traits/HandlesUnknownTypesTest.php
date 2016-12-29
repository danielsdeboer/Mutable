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
     * The mocked object that uses the trait
     * @var Object
     */
    protected $mock;

    protected function setUp()
    {
        $this->mock = $this->getMockForTrait(HandlesUnknownTypes::class);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_unknown_type_will_return_an_instance_of_the_proper_type()
    {
        $type = $this->mock->unknownType(2);

        $this->assertInstanceOf(Int::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_an_unhandled_type_throws_a_type_exception()
    {
        try {
            $type = $this->mock->unknownType(true);
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
        $type = $this->mock->unknownType('string');

        $this->assertInstanceOf(Str::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function providing_a_float_will_return_an_instance_of_flt()
    {
        $type = $this->mock->unknownType(1.222);

        $this->assertInstanceOf(Flt::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function providing_an_integer_will_return_an_instance_of_int()
    {
        $type = $this->mock->unknownType(1222);

        $this->assertInstanceOf(Int::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function providing_an_array_will_return_an_instance_of_arr()
    {
        $type = $this->mock->unknownType([1,2]);

        $this->assertInstanceOf(Arr::class, $type);
    }

    /**
     * @expectedException Aviator\Mutable\Exceptions\TypeException
     * @group unknownTypes
     * @test
     */
    public function providing_null_will_throw_a_type_error()
    {
        $type = $this->mock->unknownType(null);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_the_int_method_will_return_an_instance_of_int()
    {
        $type = $this->mock->int(1);

        $this->assertInstanceOf(Int::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function passing_a_non_int_to_the_int_method_will_return_the_correct_instance()
    {
        $type = $this->mock->int('string');

        $this->assertInstanceOf(Str::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_the_str_method_will_return_an_instance_of_str()
    {
        $type = $this->mock->str('test string');

        $this->assertInstanceOf(Str::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function passing_a_non_str_to_the_str_method_will_return_the_correct_instance()
    {
        $type = $this->mock->str([1,2]);

        $this->assertInstanceOf(Arr::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_the_flt_method_will_return_an_instance_of_flt()
    {
        $type = $this->mock->flt(1.222);

        $this->assertInstanceOf(Flt::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function passing_a_non_flt_to_the_flt_method_will_return_the_correct_instance()
    {
        $type = $this->mock->flt([1,2]);

        $this->assertInstanceOf(Arr::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_the_arr_method_will_return_an_instance_of_arr()
    {
        $type = $this->mock->arr([1,2]);

        $this->assertInstanceOf(Arr::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function passing_a_non_arr_to_the_arr_method_will_return_the_correct_instance()
    {
        $type = $this->mock->arr('test string');

        $this->assertInstanceOf(Str::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_the_numeric_method_will_return_an_instance_of_flt()
    {
        $type = $this->mock->numeric(22);

        $this->assertInstanceOf(Int::class, $type);
    }

    /**
     * @group unknownTypes
     * @test
     */
    public function calling_the_numeric_method_will_return_an_instance_of_int()
    {
        $type = $this->mock->numeric(22.22);

        $this->assertInstanceOf(Flt::class, $type);
    }
}