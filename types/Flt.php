<?php

// namespace Str;

class Flt extends MutableChildBase {

    /**
     * Validate the input
     * @param  float $input
     * @return float
     */
    public function validate($input)
    {
        if (! is_float($input)) {
            throw new Exception('The input was not a float');
        }

        return $input;
    }
}