<?php

namespace Aviator\Mutable\Types;

use Aviator\Mutable\Abstracts\TypeBase;
use Aviator\Mutable\Exceptions\TypeException;

class Null extends TypeBase {

    /**
     * Validate the input
     * @param  string $input
     * @return string
     */
    public function validate($input)
    {
        if (! is_null($input)) {
            throw new TypeException('The input was not null');
        }

        return $input;
    }
}