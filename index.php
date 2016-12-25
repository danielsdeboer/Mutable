<?php

require 'core/bootstrap.php';

$string = Mutable::make('string-string2')
            ->unslug()
            ->get()
            ;

var_dump($string);
