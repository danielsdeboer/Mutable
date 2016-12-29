<?php

namespace Aviator\Mutable\Traits;

use Aviator\Mutable\Exceptions\TypeException;
use Aviator\Mutable\Types\Arr;
use Aviator\Mutable\Types\Flt;
use Aviator\Mutable\Types\Int;
use Aviator\Mutable\Types\Str;

trait HandlesUnknownTypes {
    /**
     * If the return type is unknown, figure it out
     * @param  mixed $value
     * @return mixed
     */
    public function unknownType($value)
    {
        switch (true) {
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
    public function str($value)
    {
        try {
            $str = Str::make($value);
        } catch (TypeException $e) {
            $str = $this->unknownType($value);
        }

        return $str;
    }

    /**
     * Create a new Int
     * @param  int $value
     * @return Int | mixed
     */
    public function int($value)
    {
        try {
            $int = Int::make($value);
        } catch (TypeException $e) {
            $int = $this->unknownType($value);
        }

        return $int;
    }

    /**
     * Create a new Flt
     * @param  float $value
     * @return Flt | mixed
     */
    public function flt($value)
    {
        try {
            $flt = Flt::make($value);
        } catch (TypeException $e) {
            $flt = $this->unknownType($value);
        }

        return $flt;
    }

    /**
     * Create a new Arr
     * @param  array $value
     * @return Arr | mixed
     */
    public function arr($value)
    {
        try {
            $arr = Arr::make($value);
        } catch (TypeException $e) {
            $arr = $this->unknownType($value);
        }

        return $arr;
    }

    /**
     * For operations where int or float is ambiguous, test to see
     * which Type should be returned.
     * @param  int | float $value
     * @return Int | Flt
     */
    public function numeric($value)
    {
        if (floor($value) == $value) {
            return $this->int((int) $value);
        }

        return $this->flt($value);
    }
}