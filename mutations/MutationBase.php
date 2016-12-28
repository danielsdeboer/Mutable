<?php

abstract class MutationBase implements Mutation {

    use HandlesUnknownTypes;

    protected $in;
    protected $out;
    protected $params;

    /**
     * Constructor
     * @param MutableChild $mutable
     * @param array $params
     */
    public function __construct(MutableChild $mutable, array $params)
    {
        $this->in = $mutable;
        $this->params = $params;
    }

    /**
     * Static constructor
     * @param  MutableChild $mutable
     * @param  array $params
     * @return $this
     */
    public static function make($mutable, $params)
    {
        $child = get_called_class();

        return (new $child($mutable, $params))->run();
    }

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
     * Get the value of the MutableChild
     * @return mixed
     */
    protected function value()
    {
        return $this->in->get();
    }

    /**
     * Get the mutated return value
     * @return mixed
     */
    public function get()
    {
        return $this->out;
    }

    /**
     * Perform the mutation
     * @return mixed
     */
    abstract public function run();
}