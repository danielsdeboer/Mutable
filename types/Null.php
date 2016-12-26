<?php

// namespace Str;

class Null extends MutableChildBase {

    /**
     * Validate the input
     * @param  string $input
     * @return string
     */
    public function validate($input)
    {
        if (! is_null($input)) {
            throw new Exception('The input was not null');
        }

        return $input;
    }
}