<?php
// 类内部, 自身
class Person{
    public $name = "zhansan";
    public function getName(){
        echo $this->name;
    }
}
$student = new Person();
 $student->getName();

