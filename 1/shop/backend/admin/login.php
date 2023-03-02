<?php 
require_once '../db.func.php';
require_once '../tools.func.php';

// 1. 连接数据库
if(!empty($_POST['adminuser'])){
  // 获取数据表的前缀
  $prefix = getDBPrefix();
  $adminuser = $_POST['adminuser'];
  $adminpass = md5('yunhe_'.md5($_POST['adminpass']));
  // 拼接sql语句
  $sql = "select
  id,adminuser 
  from {$prefix}admin 
  where 
  adminuser = '{$adminuser}' 
  and
  adminpass = '{$adminpass}'
  ";

  $result = queryOne($sql);
  if ($result) {
    setSession('admin',['adminuser'=>$result['adminuser'],'id'=>$result['id']],'admin');
    // 当前登陆时间
    $login_at = date('Y-m-d H:i:s');
    // 当前登录IP

    $ip = $_SERVER['REMOTE_ADDR'] == "::1"? '127.0.0.1':$_SERVER['REMOTE_ADDR'];
    //用当前网络的internet协议(版本4)和版本(6)解析ip地址
    $login_ip = ip2long($ip); 

    $sql = "update {$prefix}admin 
    set login_at = '{$login_at}',
    login_ip = '{$login_ip}' 
    where id = {$result['id']}";
    execute($sql);
    header('location:index.php');
  }else{
    setInfo('用户名或密码错误');
  }
}
?>

<!doctype html>
<html>

<head>
  <title>云和商城</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="assets/css/googlefonts.css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>

<body>
  <div class="wrapper ">
    <div>
      <div>
        <div class="container" style="width: 50%;margin-top: 250px;">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">登录</h4>
                    <p class="card-category">以管理员身份登录后台</p>
                  </div>
                  <div class="card-body">
                    <p>
                      
                    <?php if(hasInfo()) echo getInfo(); ?>
                    </p>
                    <form method='post'>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">用户名</label>
                            <input type="text" name='adminuser' class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">密码</label>
                            <input type="password" name="adminpass" class="form-control">
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary pull-right">登录</button>
                      <div class="clearfix"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
</body>

</html>