<?php

require_once '../db.func.php';
require_once '../tools.func.php';
$prefix = getDBPrefix();

$userid = $_GET['id'];

$sql = "delete from {$prefix}cart where user_id = $userid";

$res = execute($sql);
if ($res) {
	setInfo("用户id为 {$userid} 的购物车已清空!",'carts.php');
}else{
	setInfo("清除用户id为 {$userid} 的购物车失败!",'carts.php');
}
header('location:carts.php');
