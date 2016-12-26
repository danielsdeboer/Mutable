<?php

interface Mutation {
    public function __construct(MutableChild $mutable, array $params);
    public static function make($mutable, $params);
    public function get();
    public function run();
}