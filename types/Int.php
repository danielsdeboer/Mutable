<?php

// namespace Str;

class Int extends MutableChildBase {

    /**
     * Validate the input
     * @param  int $input
     * @return int
     */
    public function validate($input)
    {
        if (! is_integer($input)) {
            throw new Exception('The input was not a integer');
        }

        return $input;
    }
}