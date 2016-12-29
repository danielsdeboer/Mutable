<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MutationBase;

class Dollars extends MutationBase {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->out = Str::make(implode($this->params[0], $this->value()));

        return $this;
    }

    protected function dollars()
    {
        $this->mutate('twoPlaces');

        return $this->str('$' . $this->value());
    }
}
