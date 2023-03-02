<?php

require_once '../db.func.php';
require_once '../tools.func.php';

$prefix = getDBPrefix();

$id = $_GET['id'];

$sql = "select * from {$prefix}product where id = $id";

$product = queryOne($sql);





if (!empty($_POST) && check_form()) {
	$name = $_POST['name'];
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$code = $_POST['code'];
	$description = $_POST['description'];

	$sql = "UPDATE `{$prefix}product` SET `name` = '$name', `code` = '$code', `description` = '$description', `stock` = $stock, `price` = $price WHERE `id` = $id";


	if (execute($sql)) {
		setInfo("id为 {$id} 的商品, 修改成功!",'products.php');
		header('location:products.php');
	}else{
		setInfo('商品编辑失败!');
	}


}

// function check_form(){

// 	if ($_POST['name'] === "") {
// 		setInfo('商品名称不能为空!');
// 		return false;
// 	}
// 	if ($_POST['price'] === "") {
// 		setInfo('商品价格不能为空!');
// 		return false;
// 	}
// 	if(floatval($_POST['price']) < 0){
// 		setInfo('商品价格不能为负数!');
// 		return false;
// 	}
// 	if ($_POST['stock'] === "") {
// 		setInfo('请填写库存!');
// 		return false;
// 	}
// 	if(floatval($_POST['stock']) < 0){
// 		setInfo('商品库存不能为负数!');
// 		return false;
// 	}
// 	if ($_POST['code'] === "") {
// 		setInfo('商品编号不能为空!');
// 		return false;
// 	}
// 	if ($_POST['description'] === "") {
// 		setInfo('商品描述不能为空!');
// 		return false;
// 	}
// 	return true;
// }


?>





<?php include_once 'header.php'; ?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<h4 class="card-title">编辑商品</h4>
				<p class="card-category">编辑商品信息</p>
			</div>
			<div class="card-body">
				<p><?php if(hasInfo()) echo getInfo(); ?></p>
				<form method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">商品名称</label>
								<input type="text" name="name" value="<?php echo $product['name']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">商品单价</label>
								<input type="number" name="price" value="<?php echo $product['price']; ?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">商品库存</label>
								<input type="number" name="stock" value="<?php echo $product['stock']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">商品编号</label>
								<input type="text" name="code" value="<?php echo $product['code']; ?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>商品描述</label>
								<div class="form-group bmd-form-group">
									<textarea id="description" name="description" class="form-control" rows="5"><?php echo $product['description']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary pull-right">修改商品</button>
					<div class="clearfix"></div>
				</form>
				</div>
			</div>
		</div>

	</div>
</div>
<?php include_once 'footer.php'; ?>
