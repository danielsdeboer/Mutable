<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MetaMutation;
use Aviator\Mutable\Mutations\Times;
use Aviator\Mutable\Mutations\ToInt;
use Aviator\Mutable\Mutations\TwoPlaces;

class Cents extends MetaMutation {

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
            Times::make($this->mutatedType(), [100])
        );

        $this->record(
            ToInt::make($this->mutatedType(), [])
        );

        $this->send();

        return $this;
    }
}
