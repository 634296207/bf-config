<?php

namespace A\B;
class MyClass
{
    public function __construct()
    {
        echo '空间A\B 中的类 实例化了' . "\n";
    }
}

namespace A;
class MyClass
{
    public function __construct()
    {
        echo '空间A 中的类 实例化了' . "\n";
    }
}

//$obj = new MyClass();// 非限定名称 就近
//$obj = new \A\B\MyClass();// 完全限定名称 绝对路径
//$obj = new \A\MyClass();// 完全限定名称 绝对路径
$obj = new B\MyClass();//限定名称 相对路径