<?php
// 受到命名空间影响的
// 1.函数 可以定义 调用的时候 需要跟上命名空间
// 2.常量 不能定义
// 3.类

// 掌握: 如何定义一个命名空间,声明
//       如何使用命名空间来调用 \命名空间名称\[函数名()|类名]
namespace a02;
include "init.php";
class Person{
    public function __construct()
    {
        echo "02.php";
    }
}
function demo(){
    echo "my demo";
}

\a02\demo();
\init\demo();
//define("APP",'my_web');

//$a = 1;
//$a = 2;
//\init\demo();

//\init\abc();

//$p = new \init\Person();
//
//$p1 = new Person();



