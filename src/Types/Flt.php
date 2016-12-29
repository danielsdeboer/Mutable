<?php

namespace Aviator\Mutable\Types;

use Aviator\Mutable\Abstracts\TypeBase;
use Aviator\Mutable\Exceptions\TypeException;

class Flt extends TypeBase {

    /**
     * Validate the input
     * @param  float $input
     * @return float
     */
    public function validate($input)
    {
        if (! is_float($input)) {
            throw new TypeException('The input was not a float');
        }

        return $input;
    }
}