<?php

use Aviator\Mutable\Exceptions\TypeException;
use Aviator\Mutable\Types\Null;

class NullTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @group null
     * @test
     */
    public function calling_make_with_null_returns_an_instance_of_null()
    {
        $null = Null::make(null);

        $this->assertInstanceOf(Null::class, $null);
    }

    /**
     * @group null
     * @test
     */
    public function calling_make_with_a_non_null_throws_a_type_exception()
    {
        try {
            $null = Null::make(1.222);

        } catch (TypeException $e) {
            return;
        }

        $this->fail();
    }

}