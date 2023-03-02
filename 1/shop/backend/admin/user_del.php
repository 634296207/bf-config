<?php


require_once '../db.func.php';
require_once '../tools.func.php';

$prefix = getDBPrefix();
$id = $_GET['id'];

$sql = "delete from {$prefix}user where id = {$id}";

if(execute($sql)){
	setInfo("ID为 {$id} 的用户删除成功!!!");
}else{
	setInfo("ID为 {$id} 的用户删除失败!");
}
header('location:users.php');