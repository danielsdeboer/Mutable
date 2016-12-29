<?php

namespace Aviator\Mutable\Types;

use Aviator\Mutable\Abstracts\TypeBase;
use Aviator\Mutable\Exceptions\TypeException;

class Int extends TypeBase {

    /**
     * Validate the input
     * @param  int $input
     * @return int
     */
    public function validate($input)
    {
        if (! is_integer($input)) {
            throw new TypeException('The input was not a integer');
        }

        return $input;
    }
}