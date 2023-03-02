<?php include_once "header.php"; ?>

<?php
if (!$current_user) {
	echo "<script>window.location.href = 'login.php';</script>";
}



// 新增订单数据
$cart_str = serialize($cart_result);
$created_at = date('Y-m-d H:i:s');
$user_id = $current_user['id'];
$sql = 
<<<TOC
INSERT INTO `{$prefix}order`(`price`, `quantity`, `products`, `uid`, `created_at`) VALUES ($total_price, $total_count,'$cart_str',$user_id, '$created_at')
TOC;
$res1 = execute($sql);
// 更新库存
foreach ($cart_result as $key => $cart) {
	$proid = $cart['proid'];
	$product_count = $cart['product_count'];
	$old_stock = intval(queryOne("select stock from {$prefix}product where id = $proid")['stock']);
	$current_stock = $old_stock - intval($product_count);
	$sql = "update {$prefix}product set stock = $current_stock where id = $proid";
	$res2 = execute($sql);
}
// 删除购物车数据
$sql = "delete from {$prefix}cart where user_id = $user_id";
$res3 = execute($sql);

?>


	<div class="cart-main-area bg__white">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;padding: 50px;">
					<?php if($res1 && $res2 && $res3): ?>
					<h1 style="color: green;">支付成功！</h1>
					<?php else: ?>
					<h1 style="color: red;">支付失败！</h1>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>

	<div class="only-banner ptb--10 bg__white">
	</div>
<?php include_once "footer.php"; ?>