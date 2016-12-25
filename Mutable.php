<?php

class Mutable
{
    /**
     * The mutations list
     * @var array
     */
    private $mutations = [];

    ///////////
    // SETUP //
    ///////////

    /**
     * Create a new instance of a mutable
     * @param string | int | float | array $mutable
     */
    public function __construct($mutable)
    {
        $mutable = $this->unknownType($mutable);

        $this->mutate('create', $mutable);
    }

    /**
     * Static constructor
     * @param  mixed $mutable
     * @return Mutable
     */
    public static function make($mutable)
    {
        return new self($mutable);
    }

    ////////////
    // MUTATE //
    ////////////

    /**
     * Record the mutated state, the mutation name, and the parameter
     * @param  string $method
     * @param  array | null $params
     * @return $this
     */
    protected function mutate($method, $params = null)
    {
        $this->record(
            $this->$method($params),
            $method,
            $params
        );

        return $this;
    }

    /**
     * Record the mutation, enforcing the return of a MutableChild
     * @param  MutableChild $mutated
     * @param  string $method
     * @param  array $params
     * @return void
     */
    protected function record(MutableChild $mutated, $method, $params)
    {
        $this->mutations[] = MutationRecord::make(
            $mutated,
            $method,
            is_array($params) ? $params : []
        );
    }

    ///////////////
    // MUTATIONS //
    ///////////////

    /**
     * Creation mutation.
     * @param  Object $parameter
     * @return Object
     */
    protected function create($obj)
    {
        return $obj;
    }

    ////////////////////////////////
    // STRING TO STRING MUTATIONS //
    ////////////////////////////////

    /**
     * Convert string to uppercase
     * @return string
     */
    protected function caps()
    {
        return $this->str($this->value());
    }

    /**
     * Remove all instances of a string
     * @param  string $string
     * @return string
     */
    protected function remove($string)
    {
        return $this->str(str_replace($string, '', $this->value()));
    }

    /**
     * Replace all instances of a string with another string
     * @param  array $params
     * @return string
     */
    protected function replace($params)
    {
        return $this->str(str_replace($params[0], $params[1], $this->value()));
    }

    protected function titleCase()
    {
        $this->mutate('explode', [' ']);
        $this->mutate('map', ['ucfirst']);

        return $this->str(implode($this->value(), ' '));
    }

    protected function metaUnslug()
    {
        $this->mutate('replace', ['-', ' ']);
        $this->mutate('titlecase');
    }

    ///////////////////////////////
    // STRING TO ARRAY MUTATIONS //
    ///////////////////////////////

    /**
     * Explode the string
     * @param  string $delimiter
     * @return Arr
     */
    protected function explode($params)
    {
        return $this->arr(explode($params[0], $this->value()));
    }

    ///////////////////////////////
    // ARRAY TO STRING MUTATIONS //
    ///////////////////////////////

    protected function implode($params)
    {
        return $this->str(implode($params[0], $this->value()));
    }

    /////////////////////
    // FLOAT TO STRING //
    /////////////////////

    protected function dollars()
    {
        $this->mutate('twoPlaces');

        return $this->str('$' . $this->value());
    }

    ////////////////////
    // FLOAT TO FLOAT //
    ////////////////////

    protected function round($places)
    {
        return $this->flt(round($this->value(), isset($places[0]) ? $places[0] : 2));
    }

    //////////////////
    // FLOAT TO INT //
    //////////////////

    protected function dollarsToCents()
    {
        $this->mutate('twoPlaces');
        $this->mutate('times', [100]);

        return $this->int($this->toInt($this->value()));
    }

    /////////////////////
    // FLOAT TO STRING //
    /////////////////////

    protected function twoPlaces()
    {
        return $this->flt(number_format($this->value(), 2));
    }


    //////////
    // MATH //
    //////////

    /**
     * Perform a multiplication operation
     * @param  array $params
     * @return Int | Float
     */
    protected function times($params)
    {
        return $this->intOrFlt($this->value() * $params[0]);
    }

    protected function minus($params)
    {
        return $this->intOrFlt($this->value() - $params[0]);
    }

    protected function plus($params)
    {
        return $this->intOrFlt($this->value() + $params[0]);
    }

    protected function divBy($params)
    {
        return $this->intOrFlt($this->value() / $params[0]);
    }

    protected function divInto($params)
    {
        return $this->intOrFlt($params[0] / $this->value());
    }

    protected function pow($params)
    {
        return $this->intOrFlt( pow($this->value(), $params[0]) );
    }

    protected function root($params)
    {
        return $this->intOrFlt( pow($this->value(), 1/$params[0]) );
    }

    //////////////
    // FUNCTION //
    //////////////

    protected function run($params)
    {
        $mutated = call_user_func($params[0], $this->value());

        return $this->unknownType($mutated);
    }

    protected function map($params)
    {
        return $this->arr(array_map($params[0], $this->value()));
    }


    //////////////////////////
    // NON-MUTATION HELPERS //
    //////////////////////////

    /**
     * For operations where int or float is ambiguous, test to see
     * which mutable child should be returned.
     * @param  mixed $value
     * @return Int | Flt
     */
    protected function intOrFlt($value)
    {
        if (floor($value) == $value) {
            return Int::make($this->toInt($value));
        }

        if ($this->isInt() && $this->isInt($value)) {
            return Int::make($value);
        }

        return Flt::make($value);
    }

    /**
     * If the return type is unknown, figure it out
     * @param  mixed $value
     * @return void
     */
    protected function unknownType($value)
    {
        switch (true) {
            case $value === null:
                $this->fail();
                break;

            case is_string($value):
                return $this->str($value);
                break;

            case is_integer($value):
                return $this->int($value);
                break;

            case is_float($value):
                return $this->flt($value);
                break;

            case is_array($value):
                return Arr::make($value);
                break;

            default:
                $this->fail();
                break;
        }
    }

    /**
     * Throw an exception for unacceptable types
     * @return void
     */
    protected function fail()
    {
        throw new TypeException('The input must be a string, integer, float, or array.');
    }

    /**
     * Cast to integer in non-mutation context
     * @param  mixed $input
     * @return int
     */
    protected function toInt($input)
    {
        return (int) $input;
    }


    /**
     * Test the current value or a test value
     * @return boolean
     */
    protected function isInt($test = null)
    {
        if ($test) {
            return is_int($test);
        }

        return is_int($this->value());
    }

    /**
     * Is the current value a float
     * @return boolean
     */
    protected function isFlt()
    {
        return is_float($this->value());
    }

    ////////////////////
    // CHILD CREATORS //
    ////////////////////

    /**
     * Create a new Str
     * @param  string $value
     * @return Str | mixed
     */
    protected function str($value)
    {
        try {
            $str = Str::make($value);
        } catch (Exception $e) {
            $str = $this->unknownType($value);
        }

        return $str;
    }

    /**
     * Create a new Int
     * @param  int $value
     * @return Int | mixed
     */
    protected function int($value)
    {
        try {
            $int = Int::make($value);
        } catch (Exception $e) {
            $int = $this->unknownType($value);
        }

        return $int;
    }

    /**
     * Create a new Flt
     * @param  float $value
     * @return Flt | mixed
     */
    protected function flt($value)
    {
        try {
            $flt = Flt::make($value);
        } catch (Exception $e) {
            $flt = $this->unknownType($value);
        }

        return $flt;
    }

    /**
     * Create a new Arr
     * @param  array $value
     * @return Arr | mixed
     */
    protected function arr($value)
    {
        try {
            $arr = Arr::make($value);
        } catch (Exception $e) {
            $arr = $this->unknownType($value);
        }

        return $arr;
    }

    /////////////
    // GETTERS //
    /////////////

    /**
     * Get the last value in the mutations array and call the get() method on it
     * @return mixed
     */
    protected function value()
    {
        return end($this->mutations)->value();
    }

    /**
     * Public alias for value()
     * @return mixed
     */
    public function get()
    {
        return $this->value();
    }

    /**
     * Return the list of mutations
     * @return array
     */
    public function mutations()
    {
        return $this->mutations;
    }

    /**
     * Redirect calls to protected methods to the mutation
     * returning $this so the __call'ed methods are fluent
     * @param  string $method
     * @param  array $params
     * @return $this
     */
    public function __call($method, $params)
    {
        if (method_exists($this, $method)) {
            $this->mutate($method, $params);

            return $this;
        }

        $metaMethod = 'meta' . ucfirst($method);

        if (method_exists($this, $metaMethod)) {
            $this->$metaMethod();
        }

        return $this;
    }

    /**
     * Magic getter
     * @param  string $property
     * @return mixed | null
     */
    public function __get($property)
    {
        if ($property == 'value') {
            return $this->value();
        }

        return null;
    }

}