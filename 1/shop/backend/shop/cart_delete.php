<?php
session_id() || session_start();
require_once '../tools.func.php';
require_once '../db.func.php';
$prefix = getDBPrefix();
$current_user = getSession('user', 'shop');

$id = $_GET['id'];
if ($current_user) {
    $sql = "delete from {$prefix}cart where id = $id";
    if (!execute($sql)) {
        setInfo('删除购物车失败!');
    }
} else {
    $cart_session = getSession('cart', 'shop');
    foreach ($cart_session as $key => $cart) {
        if ($cart['id'] == $id) {
            unset($cart_session[$key]);
        }
    }
    setSession('cart', $cart_session, 'shop');
}
if (isset($_GET['pos']) && $_GET['pos'] == "right") {
    echo "<script>history.go(-1);</script>";
} else {
    header('location:cart.php');
}