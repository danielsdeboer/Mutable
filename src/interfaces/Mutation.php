<?php

namespace Aviator\Mutable\Interfaces;

use Aviator\Mutable\Interfaces\Type;

interface Mutation {
    public function __construct(Type $type, array $params);
    public static function make($type, $params);
    public function get();
    public function run();
}