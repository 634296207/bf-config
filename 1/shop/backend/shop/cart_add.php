<?php
// 开启session
session_id() || session_start();
// 引入文件
require_once '../tools.func.php';
require_once '../db.func.php';
// 数据表前缀
$prefix = getDBPrefix();
// 获取当前用户
$current_user = getSession('user', 'shop');
// 如果post非空, 说明从详情页添加购物车
if (!empty($_POST)) {
    $product_id = $_POST['product_id'];
    $product_count = $_POST['qtybutton'];
}
// 如果get非空, 说明从按钮添加购物车
if (!empty($_GET)) {
    $product_id = $_GET['id'];
    $product_count = $_GET['count'];
    $method = 'get';
}


// 如果登录
if ($current_user) {
    // 获取用户id
    $user_id = $current_user['id'];
    add_cart($product_id, $product_count, $user_id, $prefix);
} else {
    // 如果没有登录, 购物车写到session中
    // 先通过商品id, 获取商品的名称, 缩略图, 价格, 库存
    $product_result = queryOne("select name,pic,price,stock from {$prefix}product where id = $product_id");
    // 获取session, 判断session是否已经有购物车的记录
    $cart_result = getSession('cart', 'shop') ? getSession('cart', 'shop') : [];
    // 标记
    $add = true;
    // 遍历session, 如果已经有值, 更新, 如果没值, 插入
    foreach ($cart_result as $key => $cart) {
        // 更新数量
        if ($cart['proid'] == $product_id) {
            $add = false;
            $cart['product_count'] = intval($cart['product_count']) + intval($product_count);
            $cart_result[$key] = $cart;
        }
    }
    // 新增该商品的信息
    if ($add) {
        array_unshift($cart_result, [
            'name' => $product_result['name'],
            'pic' => $product_result['pic'],
            'price' => $product_result['price'],
            'stock' => $product_result['stock'],
            'product_count' => $product_count,
            'proid' => $product_id,
            'id' => count($cart_result) + 1,
        ]);
    }
    // 保存session
    setSession('cart', $cart_result, 'shop');
}



if (isset($method)) {
    echo "<script>history.go(-1)</script>";
} else {
    header('location:cart.php');
}

?>