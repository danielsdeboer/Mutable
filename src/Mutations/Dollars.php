<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MetaMutation;

class Dollars extends MetaMutation {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->record(
            TwoPlaces::make($this->initialType(), [])
        );

        $this->record(
            Prepend::make($this->mutatedType(), ['$'])
        );

        $this->send();

        return $this;
    }
}
