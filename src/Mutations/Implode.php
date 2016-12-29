<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class Implode extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = $this->str(
            implode($this->params[0], $this->value())
        );

        return $this;
    }
}
