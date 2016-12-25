<?php

class MutationRecord {

    /**
     * An object that conforms to the mutable child interface contract
     * @var MutableChild
     */
    protected $mutableChild;

    /**
     * The name of the mutation
     * @var string
     */
    protected $mutation;

    /**
     * The parameters that were passed with the mutation
     * @var array
     */
    protected $parameters;

    /**
     * Constructor
     * @param MutableChild $mutableChild
     * @param string $mutation
     * @param array | null $parameters
     */
    public function __construct(MutableChild $mutableChild, $mutation, array $parameters)
    {
        $this->mutableChild = $mutableChild;
        $this->mutation = $mutation;
        $this->parameters = $parameters;
    }

    /**
     * Static constructor
     * @param  MutableChild $mutableChild
     * @param  string $mutation
     * @param  array | null $parameters
     * @return Mutation
     */
    public static function make(MutableChild $mutableChild, $mutation, $parameters)
    {
        return new self($mutableChild, $mutation, $parameters);
    }

    /**
     * Get the mutable child's value
     * @return mixed
     */
    public function value()
    {
        return $this->mutableChild->get();
    }
}