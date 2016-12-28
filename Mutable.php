<?php

class Mutable
{
    use HandlesUnknownTypes;

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
    protected function mutate($mutation, $params = null)
    {
        // Mutations class names are in PascalCase
        $mutation = ucfirst($mutation);

        // Create is a separate case as there's no initial value
        // to call $this->value() on
        if ($mutation == 'Create') {
            $this->mutations[] = $mutation::make(Null::make(null), [$params]);

            return $this;
        }

        $this->mutations[] = $mutation::make($this->value(), $params);

        return $this;
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

    protected function dollarsToCents()
    {
        $this->mutate('twoPlaces');
        $this->mutate('times', [100]);

        return $this->int($this->toInt($this->value()));
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

    //////////////////////////
    // NON-MUTATION HELPERS //
    //////////////////////////

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

    /////////////
    // GETTERS //
    /////////////

    /**
     * Get the last MutableChild
     * @return mixed
     */
    protected function value()
    {
        return end($this->mutations)->get();
    }

    /**
     * Get the last MutableChild's value
     * @return mixed
     */
    public function get()
    {
        $value = end($this->mutations)->get();
        return $value->get();
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
        $this->mutate($method, $params);

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