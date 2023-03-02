<?php

namespace  init;

function demo(){
    echo "demo ...";
}

function abc(){
    echo 'test...';
}

define("APP",'your_web');

class Person{
    public function __construct()
    {
        echo "init.php";
    }
}