<?php

abstract class MutationBase implements Mutation {

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