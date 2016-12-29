<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class Map extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->arr(
            array_map($this->params[0], $this->value())
        );

        return $this;
    }
}
