<?php

require './String.php';
// namespace Str;

class StrOld
{
    /**
     * The String
     * @var String
     */
    private $string;

    /**
     * Create a new instance of string
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = new String($string);
    }

    /**
     * Static constructor
     * @param  string $string
     * @return Str
     */
    public static function make($string)
    {
        return new self($string);
    }

    /**
     * Get the string value
     * @return string
     */
    public function get() {
        return $this->string->get();
    }

    /**
     * Get the mutations list
     * @return array
     */
    public function getMutations()
    {
        return $this->string->mutations();
    }

    /**
     * Undo the last n mutations
     * @param  int $steps
     * @return void
     */
    public function undo($steps = 1)
    {
        $this->string->undo($steps);

        return $this;
    }

    ////////////////////
    // MUTATE AND GET //
    ////////////////////

    public function toCaps()
    {
        return $this->string->mutate('caps')->get();
    }

    public function toRemove($string)
    {
        return $this->string->mutate('remove', $string)->get();
    }

    public function toReplace($string, $with)
    {
        return $this->string->mutate('replace', [$string, $with])->get();
    }


    ///////////////////
    // MAGIC METHODS //
    ///////////////////

    /**
     * Redirect method calls to the String class mutator
     * @param  string $method
     * @param  mixed $params
     * @return void
     */
    public function __call($method, $params = null)
    {
        $this->string->mutate($method, $params);

        return $this;
    }
}