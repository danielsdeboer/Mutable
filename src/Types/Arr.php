<?php

namespace Aviator\Mutable\Types;

use Aviator\Mutable\Abstracts\TypeBase;
use Aviator\Mutable\Exceptions\TypeException;

class Arr extends TypeBase {

    /**
     * Validate the input
     * @param  string $input
     * @return string
     */
    public function validate($input)
    {
        if (! is_array($input)) {
            throw new TypeException('The input was not a array');
        }

        return $input;
    }
}