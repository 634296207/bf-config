<?php

// 继承父类的方法
class Person
{
    public $name = 'lisi';

final public function getName()
    {
        echo $this->name;
    }
}

class Student extends Person
{
     public function getName()
    {

        echo "\n";
        echo "可以继承父类!";
    }
}

$stu = new Student();
$stu->getName();
