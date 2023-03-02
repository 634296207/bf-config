<?php
session_id() || session_start();
require_once '../tools.func.php';
require_once '../db.func.php';
$prefix = getDBPrefix();
$current_user = getSession('user', 'shop');
// 从session中, 获取购物车信息
$cart_session_result = getSession('cart', 'shop') ? getSession('cart', 'shop') : [];



// 如果没有登录, 则从session中获取购物车数据
if(!$current_user){
    $cart_result = $cart_session_result;
}
// 如果登录了, 判断session中是否有数据, 如果有, 先写入数据库在查询, 如果没有, 直接查询数据库
if ($current_user) {
    // session的购物车信息, 写入数据库
    if($cart_session_result){
        deleteSession('cart','shop');
        foreach ($cart_session_result as $key => $cart_session) {
            add_cart($cart_session['proid'],$cart_session['product_count'],$current_user['id'],$prefix);
        }
        $cart_session_result = null;
    }

    
    // 查询购物车
    $sql = "SELECT
    {$prefix}product.name,
    {$prefix}product.id as proid,
    {$prefix}product.price,
    {$prefix}product.pic,
    {$prefix}product.stock,
    {$prefix}cart.product_count,
    {$prefix}cart.id
    FROM
    {$prefix}product
    INNER JOIN {$prefix}cart ON {$prefix}cart.product_id = {$prefix}product.id
    INNER JOIN {$prefix}user ON {$prefix}cart.user_id = {$prefix}user.id
    where user_id = " . $current_user['id'] . " order by {$prefix}cart.created_at desc";
    $cart_result = queryAll($sql);
} 



$total_price = 0;
$total_count = 0;
foreach ($cart_result as $key => $cart) {
    $sum = intval($cart['product_count']) * floatval($cart['price']);
    $total_price += $sum;
    $total_count += $cart['product_count'];
    $cart_result[$key]['sum'] = $sum;
}

?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>云和商城</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="assets/css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="assets/css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="assets/css/custom.css">


    <!-- Modernizr JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer">
        <!-- Start Header Style -->
        <header id="header" class="htc-header header--3 bg__white">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="assets/images/logo/logo.png" alt="logo">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                            <nav class="mainmenu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">
                                    <li><a href="index.php">首页</a></li>
                                    <li><a href="index.php">所有商品</a></li>
                                </ul>
                            </nav>

                        </div>
                        <!-- End MAinmenu Ares -->
                        <div class="col-md-2 col-sm-4 col-xs-3" style="width:100%">
                            <ul class="menu-extra">
                                <li><a href=""><span class="ti-user"></span></a>
                                    <?php if ($current_user): ?>
                                    <a href="#"><?php echo $current_user['username']; ?></a>
                                    <a href="logout.php">退出</a>
                                    <?php else: ?>
                                    <a href="login.php">登录|注册</a>
                                    <?php endif;?>
                                </li>
                                <li class="cart__menu"><span class="ti-shopping-cart"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Style -->

        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Offset MEnu -->
            <div class="offsetmenu">
                <div class="offsetmenu__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a href="index.php">
                                <img src="assets/images/logo/logo.png" alt="logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Offset MEnu -->
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <?php foreach ($cart_result as $cart): ?>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="<?php echo ($cart['pic']); ?>" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href=""><?php echo ($cart['name']); ?></a></h2>
                                <span class="quantity">数量: <?php echo ($cart['product_count']); ?></span>
                                <span class="shp__price">￥<?php echo sprintf("%.2f", $cart['sum']); ?></span>
                            </div>
                            <div class="remove__btn">
                                <a href="cart_delete.php?id=<?php echo $cart['id'] . "&pos=right"; ?>"
                                    title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">总计:</li>
                        <li class="total__price">￥<?php echo sprintf("%.2f", $total_price); ?></li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.php">查看购物车</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->