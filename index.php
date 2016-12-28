<?php

require 'core/bootstrap.php';

echo '<br>---------- Caps ----------';

$string = Mutable::make('string-string2')
            ->caps()
            // ->mutations()
            ->get()
            ;

var_dump($string);


echo '<br>---------- Remove ----------';

$string2 = Mutable::make('string-string2')
            ->remove('s')
            // ->mutations()
            ->get()
            ;

var_dump($string2);


echo '<br>---------- Replace ----------';

$string3 = Mutable::make('string-string2')
            ->replace('s', '____')
            // ->mutations()
            ->get()
            ;

var_dump($string3);


echo '<br>---------- Explode ----------';

$array = Mutable::make('string-string2')
            ->explode('-')
            ->get()
            ;

var_dump($array);


echo '<br>---------- Implode ----------';

$array2 = Mutable::make('string-string2')
            ->explode('-')
            ->implode('----x----')
            ->get()
            ;

var_dump($array2);


echo '<br>---------- Round ----------';

$float = Mutable::make(22.123456)
            ->round(4)
            ->get()
            ;

var_dump($float);


echo '<br>---------- TwoPlaces ----------';

$string4 = Mutable::make(22.123456)
            ->twoPlaces()
            ->get()
            ;

var_dump($string4);


echo '<br>---------- Act ----------';

$string5 = Mutable::make(22.123456)
            ->act(function($item) {
                return $item . ' is now a string';
            })
            ->get()
            ;

var_dump($string5);