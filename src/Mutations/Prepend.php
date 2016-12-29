<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class Prepend extends MutationBase {

    /**
     * Perform the mutation
     * @param
     * @return mixed
     */
    public function run()
    {
        $this->out = $this->str(
            $this->params[0] . $this->value()
        );

        return $this;
    }
}