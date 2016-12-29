<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class Power extends MutationBase {

    /**
     * Perform the mutation
     * @return $this
     */
    public function run()
    {
        $this->out = $this->numeric(
            pow($this->value(), $this->params[0])
        );

        return $this;
    }
}