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


    /**
     * @group mutable
     * @test
     */
    public function the_caps_mutation_returns_a_capitalized_string()
    {
        $mutable = Mutable::make('test string')->caps();

        $output = $mutable->get();

        $this->assertSame($output, 'TEST STRING');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_act_mutation_accepts_and_executes_a_closure()
    {
        $mutable = Mutable::make('test string')->act(function($item) {
            return $item . ' with some more text.';
        });

        $output = $mutable->get();

        $this->assertSame($output, 'test string with some more text.');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_explode_mutation_transforms_a_string_into_an_array()
    {
        $mutable = Mutable::make('test string')->explode(' ');

        $output = $mutable->get();

        $this->assertSame($output, ['test', 'string']);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_implode_mutation_transforms_an_array_into_a_string()
    {
        $mutable = Mutable::make('test string')->explode(' ')->implode('-');

        $output = $mutable->get();

        $this->assertSame($output, 'test-string');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_map_mutation_accepts_a_mappable_method()
    {
        $mutable = Mutable::make('test string')->explode(' ')->map('ucfirst');

        $output = $mutable->get();

        $this->assertSame($output, ['Test', 'String']);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_map_mutation_accepts_a_closure()
    {
        $mutable = Mutable::make('test string')->explode(' ')->map(function($item) {
            return ucfirst($item);
        });

        $output = $mutable->get();

        $this->assertSame($output, ['Test', 'String']);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_remove_mutation_removes_all_instances_of_a_string()
    {
        $mutable = Mutable::make('test string')->remove('s');

        $output = $mutable->get();

        $this->assertSame($output, 'tet tring');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_replace_mutation_replaces_all_instances_of_a_string()
    {
        $mutable = Mutable::make('test string')->replace('s', 'x');

        $output = $mutable->get();

        $this->assertSame($output, 'text xtring');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_round_mutation_rounds_a_float_to_n_number_of_places()
    {
        $mutable = Mutable::make(1.123456)->round(2);

        $output = $mutable->get();

        $this->assertSame($output, 1.12);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_two_places_mutation_returns_a_number_formatted_string()
    {
        $mutable = Mutable::make(1.123456)->twoPlaces();

        $output = $mutable->get();

        $this->assertSame($output, '1.12');
    }


}