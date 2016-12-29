<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class ToInt extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->int(
            (int) $this->value()
        );

        return $this;
    }
}