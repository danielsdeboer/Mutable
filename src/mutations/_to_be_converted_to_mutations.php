<?php

protected function minus($params)
{
    return $this->intOrFlt($this->value() - $params[0]);
}

protected function plus($params)
{
    return $this->intOrFlt($this->value() + $params[0]);
}

protected function divBy($params)
{
    return $this->intOrFlt($this->value() / $params[0]);
}

protected function divInto($params)
{
    return $this->intOrFlt($params[0] / $this->value());
}

protected function pow($params)
{
    return $this->intOrFlt( pow($this->value(), $params[0]) );
}

protected function root($params)
{
    return $this->intOrFlt( pow($this->value(), 1/$params[0]) );
}

//////////////////////////
// NON-MUTATION HELPERS //
//////////////////////////

/**
 * Cast to integer in non-mutation context
 * @param  mixed $input
 * @return int
 */
protected function toInt($input)
{
    return (int) $input;
}


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