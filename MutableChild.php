<?php

interface MutableChild
{
    public function __construct($input);
    public static function make($input);
    public function get();
    public function validate($input);
}