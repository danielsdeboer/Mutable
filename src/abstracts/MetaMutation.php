<?php

namespace Aviator\Mutable\Abstracts;

use Aviator\Mutable\Abstracts\MutationBase;
use Aviator\Mutable\Interfaces\Mutation;

abstract class MetaMutation extends MutationBase {

    /**
     * The list of mutations that a metamutation has performed
     * @var array
     */
    protected $mutations = [];

    /**
     * Record a mutation
     * @param  Mutation $mutation
     * @return void
     */
    protected function record(Mutation $mutation)
    {
        $this->mutations[] = $mutation;
    }

    /**
     * Return the initial value provided to the mutation.
     * Alias for $this->value() to make it context appropriate
     * in metamutations
     * @return mixed
     */
    protected function initialType()
    {
        return $this->in;
    }

    /**
     * Get the most recently mutated value
     * @return mixed
     */
    protected function mutatedType()
    {
        return end($this->mutations)->get();
    }

    /**
     * Route mutations into $this->out so the
     * receiver can interpet it
     * @return void
     */
    protected function send()
    {
        $this->out = $this->mutations;
    }
}