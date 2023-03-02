<?php


require_once '../db.func.php';
require_once '../tools.func.php';

$id = $_GET['id'];
$prefix = getDBPrefix();

$sql = "delete from {$prefix}product where id = $id";

if (execute($sql)) {
	setInfo("成功删除id为 {$id} 的商品!");
}else{
	setInfo("删除id为 {$id} 的商品失败!!!");
}
header('location:products.php');