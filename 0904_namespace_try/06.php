<?php
// 重要: 掌握如何编写自定义的异常类
// 编写的自定义异常类 必须继承 异常基类
// 了解异常基类是什么?


/*try{

    // 可能出现问题的代码
    if(){
         throw  A;

    }else if{
         throw B;
    }else{
        // 正常代码
    }


}catch (A 对应的解决方案){

}catch(B 对应的解决方案){

}*/
try{
    echo "代码执行中....";
    throw new Exception("一定会抛的...");
}catch (Exception $a){
    echo $a->getMessage()."<br>";
    echo $a->getCode()."<br>";
    echo $a->getLine()."<br>";
    echo $a->getFile()."<br>";
}
echo '正常执行代码';