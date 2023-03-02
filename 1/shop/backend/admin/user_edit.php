<?php

require_once '../db.func.php';
require_once '../tools.func.php';
$id = $_GET['id'];
$prefix = getDBPrefix();
// 根据id查询用户信息, 展示在页面上
$sql = "select username,name,age,phone,email from {$prefix}user where id = $id";
$userInfo = queryOne($sql);

if(!empty($_POST)){
	// 验证规则
	$rules = [
		'name'=>[
			'name'=>'姓名',
			'require'=>true,
		],
		'age'=>[
			'name'=>'年龄',
			'require'=>true,
			'type'=>'age',
		],
		'phone'=>[
			'name'=>'手机号',
			'require'=>true,
			'type'=>'phone',
			'is_unique'=>"select id from {$prefix}user where phone = '{$_POST['phone']}' and not id = $id",
		],
		'email'=>[
			'name'=>'邮箱',
			'require'=>true,
			'type'=>'email',
			'is_unique'=>"select id from {$prefix}user where email = '{$_POST['email']}' and not id = $id",
		]
	];

}

if(!empty($_POST) && check_form($_POST,$rules)){
	$name = $_POST['name'];
	$age = $_POST['age'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$sql = "UPDATE `{$prefix}user` SET `name` = '{$name}', `age` = {$age}, `email` = '{$email}', `phone` = '{$phone}' WHERE `id` = $id";

	if (execute($sql)) {
		// setInfo("用户信息更新成功!");
		header('location:users.php');
	}else{
		setInfo("用户信息更新失败!");
	}
}




?>









<?php include_once 'header.php'; ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<h4 class="card-title">修改用户</h4>
				<p class="card-category">修改用户信息</p>
				<p class="card-category"><?php if(hasInfo()) echo getInfo();?></p>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">用户名</label>
								<input type="text" value="<?php echo $userInfo['username'];?>" disabled class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">姓名</label>
								<input name="name" type="text" value="<?php echo $userInfo['name'];?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">年龄</label>
								<input name="age" type="number" value="<?php echo $userInfo['age'];?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">联系电话</label>
								<input type="text" name="phone" value="<?php echo $userInfo['phone'];?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">电子邮箱</label>
								<input type="text" name="email" value="<?php echo $userInfo['email'];?>" class="form-control">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary pull-right">更新信息</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>

</div>
</div>
<?php include_once 'footer.php';?>