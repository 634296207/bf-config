<?php

class Person
{
    private $sex = 'male';

    public function __set($name, $value)
    {
        echo $name, '  ', $value;
    }

}

$stu = new Person();
$stu->sex = 'female';

