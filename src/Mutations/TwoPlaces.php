<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class TwoPlaces extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->str(
            number_format($this->value(), 2)
        );

        return $this;
    }
}
