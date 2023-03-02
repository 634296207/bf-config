<?php

class Person
{
    private $sex = 'male';
    protected $age = 39;


    public function __call($name, $arguments)
    {
        var_dump($name); // 方法名字
        var_dump($arguments); // 参数数组
    }

    protected function getSex()
    {
        echo $this->sex;
    }
}

$stu = new Person();
$stu->getSex(1, 2, 3, 4);

