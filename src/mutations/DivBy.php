<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class DivBy extends MutationBase {

    /**
     * Perform the mutation
     * @return $this
     */
    public function run()
    {
        $this->out = $this->numeric(
            $this->value() / $this->params[0]
        );

        return $this;
    }
}