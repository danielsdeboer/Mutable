<?php

namespace Aviator\Mutable\Mutations;

use Aviator\Mutable\Abstracts\MetaMutation;
use Aviator\Mutable\Mutations\Explode;
use Aviator\Mutable\Mutations\Implode;
use Aviator\Mutable\Mutations\Map;

class TitleCase extends MetaMutation {

    /**
     * Perform the mutation
     * @return
     */
    public function run()
    {
        $this->record(
            Explode::make($this->initialType(), [' '])
        );

        $this->record(
            Map::make($this->mutatedType(), ['ucfirst'])
        );

        $this->record(
            Implode::make($this->mutatedType(), [' '])
        );

        $this->send();

        return $this;
    }
}
