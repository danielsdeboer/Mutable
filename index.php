<?php

require 'core/bootstrap.php';

$string = Mutable::make('string-string2')
            ->caps()
            // ->mutations()
            ->get()
            ;

var_dump($string);
