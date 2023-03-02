<?php

//定义子命名空间 避免命名空间名称重复 目录名不会重复 以目录名为名的命名空间就一定不会重复
namespace php_code\a09\my;
function my_time(){
    return 'my time';
}


echo my_time();

echo time();



echo __NAMESPACE__;