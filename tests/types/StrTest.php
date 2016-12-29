<?php

use Aviator\Mutable\Exceptions\TypeException;
use Aviator\Mutable\Types\Str;

class StrTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @group str
     * @test
     */
    public function calling_make_with_a_string_returns_an_instance_of_str()
    {
        $str = Str::make('test string');

        $this->assertInstanceOf(Str::class, $str);
    }

    /**
     * @group str
     * @test
     */
    public function calling_make_with_a_non_string_throws_a_type_exception()
    {
        try {
            $str = Str::make(1.111);

        } catch (TypeException $e) {
            return;
        }

        $this->fail();
    }

}