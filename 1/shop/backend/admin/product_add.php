<?php 

require_once '../db.func.php';
require_once '../tools.func.php';

$prefix = getDBPrefix();


if (!empty($_POST)) {
	$rules = [
		'name'=>[
			'name'=>'商品名称',
			'require'=>true,
		],
		'price'=>[

			'name'=>'商品单价',
			'require'=>true,
		],
		'stock'=>[

			'name'=>'商品库存',
			'require'=>true,
		],
		'code'=>[

			'name'=>'商品编号',
			'require'=>true,
		],
		'description'=>[

			'name'=>'商品描述',
			'require'=>true,
		],
	];
}


if (!empty($_POST) && check_form($_POST,$rules)) {


	$name = $_POST['name'];
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$code = $_POST['code'];
	$description = $_POST['description'];
	$created_at = date('Y-m-d H:i:s');



	$sql = "INSERT INTO `{$prefix}product`(`name`, `code`, `description`, `stock`, `price`, `created_at`) 
	VALUES 
	('{$name}', '{$code}', '{$description}', {$stock}, {$price}, '{$created_at}')";


	if (execute($sql)) {
		setInfo("成功添加商品, 名称为 {$name} !",'products.php');
		header('location:products.php');
	}else{
		setInfo("添加商品失败!");

	}
}

?>




<?php include_once 'header.php'; ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<h4 class="card-title">添加商品</h4>
				<p class="card-category">添加一个商品</p>
			</div>
			<div class="card-body">
				<p><?php if(hasInfo()) echo getInfo();?></p>
				<form method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">商品名称</label>
								<input type="text" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">商品单价</label>
								<input type="number" name="price" value="<?php if(isset($_POST['price'])) echo $_POST['price'];?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">商品库存</label>
								<input type="number" name="stock" value="<?php if(isset($_POST['stock'])) echo $_POST['stock'];?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">商品编号</label>
								<input type="text" name="code" value="<?php if(isset($_POST['code'])) echo $_POST['code'];?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>商品描述</label>
								<div class="form-group bmd-form-group">
									<textarea name="description" class="form-control" rows="5"><?php if(isset($_POST['description'])) echo $_POST['description'];?></textarea>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary pull-right">添加商品</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>

</div>
</div>
<?php include_once 'footer.php';?>