<?php

class MutationRecord {

    /**
     * An object that conforms to the mutable child interface contract
     * @var MutableChildInterface
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
     * @param MutableChildInterface $mutableChild
     * @param string                $mutation
     * @param array | null          $parameters
     */
    public function __construct(MutableChildInterface $mutableChild, $mutation, array $parameters)
    {
        $this->mutableChild = $mutableChild;
        $this->mutation = $mutation;
        $this->parameters = $parameters;
    }

    /**
     * Static constructor
     * @param  MutableChildInterface $mutableChild
     * @param  string                $mutation
     * @param  array | null          $parameters
     * @return Mutation
     */
    public static function make(MutableChildInterface $mutableChild, $mutation, $parameters)
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