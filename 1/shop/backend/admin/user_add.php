<?php

require_once "../db.func.php";
require_once "../tools.func.php";

$prefix = getDBPrefix();

if (!empty($_POST)) {
    // 书写表单验证规则
    $rules = [
        'username' => [
            'name' => '用户名',
            'require' => true,
            'is_unique' => "select * from {$prefix}user where username = '" . $_POST['username'] . "'",
        ],
        'password' => [
            'name' => '用户密码',
            'require' => true,
        ],
        'confirm_password' => [
            'name' => '确认密码',
            'require' => true,
            'is_equal' => 'password',
        ],
        'name' => [
            'name' => '用户姓名',
            'require' => true,
        ],
        'age' => [
            'name' => '年龄',
            'require' => true,
            'type' => 'age',
        ],
        'phone' => [
            'name' => '手机号',
            'require' => true,
            'type' => 'phone',
            'is_unique' => "select * from {$prefix}user where phone = '" . $_POST['phone'] . "'",
        ],
        'email' => [
            'name' => '邮箱',
            'require' => true,
            'type' => 'email',
            'is_unique' => "select * from {$prefix}user where email = '" . $_POST['email'] . "'",
        ],
    ];

}

if (!empty($_POST) && check_form($_POST, $rules)) {
    // 拼接sql语句, 写入数据库
    $username = $_POST['username'];
    $password = md5('yunhe_' . md5($_POST['password']));
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $created_at = date('Y-m-d H:i:s');
	$sql = "insert INTO `{$prefix}user`(`username`, `password`, `name`, `age`, `email`, `phone`, `created_at`) VALUES ('{$username}', '{$password}', '{$name}', {$age}, '{$email}', '{$phone}', '{$created_at}')";
    if (execute($sql)) {
        setInfo("成功添加用户: {$username}", 'users.php');
        header('location:users.php');
    } else {
        setInfo('添加用户失败!');
    }
}

?>




<?php include_once 'header.php';?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">添加用户</h4>
                <p class="card-category">添加一个用户</p>
            </div>
            <div class="card-body">
                <p><?php if (hasInfo()) {echo getInfo();}?></p>
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">用户名</label>
                                <input type="text" name="username"
                                    value="<?php if (isset($_POST['username'])) {echo $_POST['username'];}?>"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">密码</label>
                                <input value="<?php if (isset($_POST['password'])) {echo $_POST['password'];}?>"
                                    type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">确认密码</label>
                                <input
                                    value="<?php if (isset($_POST['confirm_password'])) {echo $_POST['confirm_password'];}?>"
                                    type="password" name="confirm_password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">姓名</label>
                                <input value="<?php if (isset($_POST['name'])) {echo $_POST['name'];}?>" type="text"
                                    name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">年龄</label>
                                <input value="<?php if (isset($_POST['age'])) {echo $_POST['age'];}?>" type="number"
                                    name="age" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">联系电话</label>
                                <input value="<?php if (isset($_POST['phone'])) {echo $_POST['phone'];}?>"
                                    type="text" name="phone" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">电子邮箱</label>
                                <input value="<?php if (isset($_POST['email'])) {echo $_POST['email'];}?>"
                                    type="text" name="email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">添加用户</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
<?php include_once 'footer.php';?>