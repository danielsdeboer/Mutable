<?php

namespace Aviator\Mutable\Abstracts;

use Aviator\Mutable\Interfaces\Mutation;
use Aviator\Mutable\Interfaces\Type;
use Aviator\Mutable\Traits\HandlesUnknownTypes;

abstract class MutationBase implements Mutation {

    use HandlesUnknownTypes;

    protected $in;
    protected $out;
    protected $params;

    /**
     * Constructor
     * @param Type $type
     * @param array $params
     */
    public function __construct(Type $type, array $params)
    {
        $this->in = $type;
        $this->params = $params;
    }

    /**
     * Static constructor
     * @param  mixed $type
     * @param  array $params
     * @return $this
     */
    public static function make($type, $params)
    {
        $child = get_called_class();

        return (new $child($type, $params))->run();
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