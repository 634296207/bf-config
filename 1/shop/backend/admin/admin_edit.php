<?php
// 引入文件
include_once '../tools.func.php';
include_once '../db.func.php';
// 获取提前获取session, 因为session_start()之前不能有输出
$current_admin = getSession('admin', 'admin');
// 判断是否点击了修改
if (!empty($_POST) && check_form()) {
    // 拼接sql语句, 更新用户的密码
    $id = $current_admin['id'];
    $adminpass = md5('yunhe_' . md5($_POST['newpwd']));
    // update修改
    // 在id里面找$adminpass修改
    $sql = "update admin set adminpass = '{$adminpass}' where id = {$id}";
    // 判断结果
    if (execute($sql)) {
        // 如果执行成功, 跳转到登录页面
        header('location:login.php');
    } else {
        // 如果执行失败, 显示信息
        setInfo('密码修改失败!');
    }
    ;
}
// 定义函数, 用来检测表单元素是否正确
// function check_form() {
//     // 定义全局变量, 否则当前用户的信息获取不到
//     global $current_admin;
//     // 如果旧密码为空...
//     if (empty($_POST['oldpwd'])) {
//         setInfo('旧密码不能为空!');
//         return false;
//     }
//     // 如果新密码为空...
//     if (empty($_POST['newpwd'])) {
//         setInfo('新密码不能为空!');
//         return false;
//     }
//     // 如果新旧密码一致...
//     if ($_POST['oldpwd'] === $_POST['newpwd']) {
//         setInfo('新密码和旧密码不能一致!');
//         return false;
//     }
//     // 如果新密码和确认密码不一致...
//     if ($_POST['newpwd'] !== $_POST['confirmpwd']) {
//         setInfo('新密码和确认密码不一致!');
//         return false;
//     }
//     // 连接数据,查询,如果查不出来, 说明旧密码错了
//     $adminuser = $current_admin['adminuser'];
//     $adminpass = md5('yunhe_' . md5($_POST['oldpwd']));
//     $sql = "select id from admin where adminuser = '{$adminuser}' and adminpass = '{$adminpass}'";
//     $result = queryOne($sql);
//     if (!$result) {
//         setInfo('旧密码错误!');
//         return false;
//     }
//     return true;
// }
include_once 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">修改用户</h4>
                <p class="card-category">用户重置密码</p>
            </div>
            <div class="card-body">
                <p>
                    <?php if (hasInfo()) {echo getInfo();}?>
                </p>
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">用户名</label>
                                <input type="text" value="<?php echo $current_admin['adminuser']; ?>" disabled
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">旧密码</label>
                                <input type="password" name="oldpwd" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">新密码</label>
                                <input type="password" name='newpwd' class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">确认密码</label>
                                <input type="password" name='confirmpwd' class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">修改</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once 'footer.php'; ?>