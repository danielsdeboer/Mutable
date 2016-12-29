<?php


/**
 * Test the current value or a test value
 * @return boolean
 */
protected function isInt($test = null)
{
    if ($test) {
        return is_int($test);
    }

    return is_int($this->value());
}

/**
 * Is the current value a float
 * @return boolean
 */
protected function isFlt()
{
    return is_float($this->value());
}