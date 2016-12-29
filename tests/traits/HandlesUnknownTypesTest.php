<?php

class HandlesUnknownTypesTest extends \PHPUnit_Framework_TestCase
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
}