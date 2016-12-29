<?php

namespace Aviator\Mutable\Tests;

use Aviator\Mutable\Mutable;
use Aviator\Mutable\Mutations\Caps;
use Aviator\Mutable\Mutations\Create;
use Aviator\Mutable\Types\Flt;
use Aviator\Mutable\Types\Int;
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

    /**
     * @group mutable
     * @test
     */
    public function the_prepend_mutation_will_add_a_string_to_the_beginning_of_a_string()
    {
        $mutable = Mutable::make('test string')->prepend('this goes in front of the ');

        $output = $mutable->get();

        $this->assertSame($output, 'this goes in front of the test string');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_dollars_mutation_rounds_and_prepends_a_float_with_a_dollar_sign()
    {
        $mutable = Mutable::make(2.223344)->dollars();

        $output = $mutable->get();

        $this->assertSame($output, '$2.22');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_title_case_mutation_transforms_a_string_to_title_case()
    {
        $mutable = Mutable::make('a test string')->titleCase();

        $output = $mutable->get();

        $this->assertSame($output, 'A Test String');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_unslug_mutation_transforms_a_slug_into_a_title_cased_string()
    {
        $mutable = Mutable::make('a-test-slug')->unslug();

        $output = $mutable->get();

        $this->assertSame($output, 'A Test Slug');
    }

    /**
     * @group mutable
     * @test
     */
    public function the_cents_mutation_transforms_a_float_into_a_cent_value_integer()
    {
        $mutable = Mutable::make(1.234)->cents();

        $output = $mutable->get();

        $this->assertSame($output, 123);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_times_mutation_multiplies_a_number_by_a_number_and_returns_an_int_or_float()
    {
        $mutable = Mutable::make(2);
        $mutableFloat = Mutable::make(2);

        $timesInt = $mutable->times(101);
        $timesFloat = $mutableFloat->times(101.1);

        $intOutput = $timesInt->get();
        $intType = $timesInt->value();

        $floatOutput = $timesFloat->get();
        $floatType = $timesFloat->value();

        $this->assertSame($intOutput, 202);
        $this->assertInstanceOf(Int::class, $intType);

        $this->assertSame($floatOutput, 202.2);
        $this->assertInstanceOf(Flt::class, $floatType);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_minus_mutation_subtracts_a_number_from_a_number()
    {
        $mutable = Mutable::make(22)->minus(2);

        $output = $mutable->get();

        $this->assertSame($output, 20);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_plus_mutation_adds_a_number_to_a_number()
    {
        $mutable = Mutable::make(22)->plus(5);

        $output = $mutable->get();

        $this->assertSame($output, 27);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_div_by_mutation_divides_the_input_by_a_number()
    {
        $mutable = Mutable::make(10)->divBy(2);

        $output = $mutable->get();

        $this->assertSame($output, 5);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_div_into_mutation_divides_the_input_into_a_number()
    {
        $mutable = Mutable::make(10)->divInto(50);

        $output = $mutable->get();

        $this->assertSame($output, 5);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_power_mutation_returns_the_power_of_a_number()
    {
        $mutable = Mutable::make(2)->power(5);

        $output = $mutable->get();

        $this->assertSame($output, 32);
    }

    /**
     * @group mutable
     * @test
     */
    public function the_root_mutation_returns_the_root_of_a_number()
    {
        $mutable = Mutable::make(8)->root(3);

        $output = $mutable->get();

        $this->assertSame($output, 2);
    }

}