<?php

session_id() ||session_start();
if(empty($_SESSION['admin'])){
  header('iocation:login.php');
}
require_once '../db.func.php';
require_once '../tools.func.php';

$prefix = getDBPrefix();
$sql = "select id,adminuser,created_at,login_at,login_ip from {$prefix}admin order by created_at desc";
$result = queryAll($sql);


include_once 'header.php';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">所有管理员</h4>
                <p class="card-category"> 控制台所有管理员列表</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class=" text-primary">
                            <th> ID </th>
                            <th> 用户名 </th>
                            <th> 创建时间 </th>
                            <th> 最后登录时间 </th>
                            <th> 最后登录IP </th>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $value): ?>
                            <tr>
                                <td> <?php echo $value['id']; ?> </td>
                                <td> <?php echo $value['adminuser']; ?> </td>
                                <td> <?php echo $value['created_at']; ?> </td>
                                <td> <?php echo $value['login_at']; ?> </td>
                                <td> <?php echo long2ip($value['login_ip']); ?> </td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once 'footer.php';?>