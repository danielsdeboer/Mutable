<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class DivInto extends MutationBase {

    /**
     * Perform the mutation
     * @return $this
     */
    public function run()
    {
        $this->out = $this->numeric(
            $this->params[0] / $this->value()
        );

        return $this;
    }
}