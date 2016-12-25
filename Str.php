<?php

// namespace Str;

class Str extends MutableChild {

    /**
     * Validate the input
     * @param  string $input
     * @return string
     */
    public function validate($input)
    {
        if (! is_string($input)) {
            throw new Exception('The input was not a string');
        }

        return $input;
    }
}