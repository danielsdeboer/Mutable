<?php

trait HandlesUnknownTypes {
    /**
     * If the return type is unknown, figure it out
     * @param  mixed $value
     * @return void
     */
    protected function unknownType($value)
    {
        switch (true) {
            case $value === null:
                $this->fail();
                break;

            case is_string($value):
                return $this->str($value);
                break;

            case is_integer($value):
                return $this->int($value);
                break;

            case is_float($value):
                return $this->flt($value);
                break;

            case is_array($value):
                return $this->arr($value);
                break;

            default:
                $this->fail();
                break;
        }
    }

    /**
     * Throw an exception for unacceptable types
     * @return void
     */
    protected function fail()
    {
        throw new TypeException('The input must be a string, integer, float, or array.');
    }

    /**
     * Create a new Str
     * @param  string $value
     * @return Str | mixed
     */
    protected function str($value)
    {
        try {
            $str = Str::make($value);
        } catch (Exception $e) {
            $str = $this->unknownType($value);
        }

        return $str;
    }

    /**
     * Create a new Int
     * @param  int $value
     * @return Int | mixed
     */
    protected function int($value)
    {
        try {
            $int = Int::make($value);
        } catch (Exception $e) {
            $int = $this->unknownType($value);
        }

        return $int;
    }

    /**
     * Create a new Flt
     * @param  float $value
     * @return Flt | mixed
     */
    protected function flt($value)
    {
        try {
            $flt = Flt::make($value);
        } catch (Exception $e) {
            $flt = $this->unknownType($value);
        }

        return $flt;
    }

    /**
     * Create a new Arr
     * @param  array $value
     * @return Arr | mixed
     */
    protected function arr($value)
    {
        try {
            $arr = Arr::make($value);
        } catch (Exception $e) {
            $arr = $this->unknownType($value);
        }

        return $arr;
    }
}