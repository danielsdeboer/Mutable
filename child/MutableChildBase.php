<?php

abstract class MutableChildBase implements MutableChild
{
    /**
     * Store for the input
     * @var mixed
     */
    protected $input;

    /**
     * Constructor
     * @param mixed $input
     */
    public function __construct($input)
    {
        $this->input = $this->validate($input);
    }

    /**
     * Static constructor; this instantiates the called child
     * instead of trying to instantiate itself.
     * @param  mixed $input
     * @return $this
     */
    public static function make($input)
    {
        $child = get_called_class();

        return new $child($input);
    }

    /**
     * Return the value
     * @return mixed
     */
    public function get()
    {
        return $this->input;
    }
}