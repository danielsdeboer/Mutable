<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MetaMutation;
use Aviator\Mutable\Mutations\Explode;
use Aviator\Mutable\Mutations\Implode;
use Aviator\Mutable\Mutations\Map;

class Unslug extends MetaMutation {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->record(
            Replace::make($this->initialType(), ['-', ' '])
        );

        $this->record(
            TitleCase::make($this->mutatedType(), [])
        );

        $this->send();

        return $this;
    }
}
