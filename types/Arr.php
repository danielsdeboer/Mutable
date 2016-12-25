<?php

// namespace Str;

class Arr extends MutableChildBase {

    /**
     * Validate the input
     * @param  string $input
     * @return string
     */
    public function validate($input)
    {
        if (! is_array($input)) {
            throw new Exception('The input was not a array');
        }

        return $input;
    }
}