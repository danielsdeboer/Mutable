<?php

use Aviator\Mutable\Mutable;
use Aviator\Mutable\Mutations\Caps;
use Aviator\Mutable\Mutations\Create;
use Aviator\Mutable\Types\Str;

class MutableTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Check if an array contains an object
     * @param  string $class
     * @param  array $array
     * @return bool
     */
    private function assertArrayContainsClass($class, $array)
    {
        foreach ($array as $item) {
            if ($item instanceof $class) {
                return true;
            }
        }

        return false;
    }

    /**
     * @group mutable
     * @test
     */
    public function calling_make_returns_an_instance_of_mutable()
    {
        $mutable = Mutable::make('test string');

        $this->assertInstanceOf(Mutable::class, $mutable);
    }

    /**
     * @group mutable
     * @test
     */
    public function caling_get_returns_the_mutated_value()
    {
        $mutable = Mutable::make('test string')->caps();

        $value = $mutable->get();

        $this->assertEquals('TEST STRING', $value);
    }

    /**
     * @group mutable
     * @test
     */
    public function calling_the_mutations_method_returns_a_list_of_mutations()
    {
        $mutable = Mutable::make('test string')->caps();

        $mutations = $mutable->mutations();

        $this->assertTrue($this->assertArrayContainsClass(Create::class, $mutations));
        $this->assertTrue($this->assertArrayContainsClass(Caps::class, $mutations));
    }
}