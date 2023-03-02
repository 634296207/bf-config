<?php

require_once "../tools.func.php";
require_once "../db.func.php";
$prefix = getDBPrefix();

// 登录逻辑
if (!empty($_POST) && $_POST['action'] == 'login') {
    $rules = [
        'username' => [
            'name' => '用户名',
            'require' => true,
        ],
        'password' => [
            'name' => '登录密码',
            'require' => true,
        ],
    ];
    if (check_form($_POST, $rules)) {
        $username = $_POST['username'];
        $password = md5('yunhe_' . md5($_POST['password']));
        $sql = "select id,name,username from {$prefix}user where username = '$username' and password = '$password'";
        if ($result = queryOne($sql)) {
            setSession('user', $result, 'shop');
            header('location:index.php');
        } else {
            setInfo('用户名或密码不正确!!!');
        }
    }
}
// 注册逻辑
if (!empty($_POST) && $_POST['action'] == 'register') {
    $rules = [
        'username' => [
            'name' => '用户名',
            'require' => true,
            'is_unique' => "select id from {$prefix}user where username = '{$_POST['username']}'",
        ],
        'email' => [
            'name' => '邮箱',
            'require' => true,
            'type' => 'email',
            'is_unique' => "select id from {$prefix}user where email = '{$_POST['email']}'",
        ],
        'password' => [
            'name' => '密码',
            'require' => true,
        ],
    ];
    if (check_form($_POST, $rules)) {
        $username = $_POST['username'];
        $password = md5('yunhe_' . md5($_POST['password']));
        $email = $_POST['email'];
        $created_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `{$prefix}user`(`username`, `password`, `email`, `created_at`) VALUES ('{$username}', '{$password}', '{$email}', '{$created_at}')";
        if ($result = execute($sql)) {
            setInfo('注册成功!');
            header('location:login.php');
        } else {
            setInfo('注册失败!!!');
        }
    }
}
?>


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
	<input type="hidden" name="current_action" value="<?php if(isset($_POST['action'])) echo $_POST['action']?>">
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
                        <!-- End MAinmenu Ares -->
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

        </div>
        <!-- End Offset Wrapper -->
        <!-- Start Login Register Area -->
        <div class="htc__login__register bg__white ptb--130">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="login__register__menu" role="tablist">
                            <li role="presentation" class="login active"><a href="#login" role="tab"
                                    data-toggle="tab">登录</a>
                            </li>
                            <li role="presentation" class="register"><a href="#register" role="tab"
                                    data-toggle="tab">注册</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p style="text-align: center;"><?php if(hasInfo()) echo getInfo(); ?></p>
                <!-- Start Login Register Content -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="htc__login__register__wrap">
                            <!-- Start Single Content -->
                            <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                                <form class="login" method="post">
                                    <input type="hidden" name="action" value="login">
                                    <input type="text" name="username" placeholder="User Name*"
                                        value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                                    <input type="password" name="password" placeholder="Password*">
                                </form>
                                <div class="htc__login__btn mt--30">
                                    <a href="javascript:document.querySelector('#login form').submit();">登录</a>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div id="register" role="tabpanel" class="single__tabs__panel tab-pane fade">
                                <form class="login" method="post">
                                    <input type="hidden" name="action" value="register">
                                    <input value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" type="text" name="username" placeholder="Name*">
                                    <input value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" type="email" name="email" placeholder="Email*">
                                    <input type="password" name="password" placeholder="Password*">
                                </form>
                                <div class="htc__login__btn">
                                    <a href="javascript:document.querySelector('#register form').submit();">注册</a>
                                </div>
                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
                <!-- End Login Register Content -->
            </div>
        </div>
        <!-- End Login Register Area -->
        <div class="only-banner ptb--10 bg__white">
        </div>
        <!-- Start Footer Area -->
        <footer class="htc__foooter__area gray-bg">
            <div class="container">
            </div>
        </footer>
        <!-- End Footer Area -->
    </div>
    <!-- Body main wrapper end -->
    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap framework js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- All js plugins included in this file. -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Waypoints.min.js. -->
    <script src="assets/js/waypoints.min.js"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="assets/js/main.js"></script>

</body>
<script>
window.onload = function() {
  var action = document.querySelector("input[name=current_action]").value;
  switch (action) {
    case "login":
      document.querySelector('a[href="#login"]').click();
      break;
    case "register":
      document.querySelector('a[href="#register"]').click();
      break;
  }
};
</script>

</html>

