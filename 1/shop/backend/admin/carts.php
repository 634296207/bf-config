<?php include_once "header.php"; ?>

<?php
require_once "../db.func.php";
require_once "../tools.func.php";
$prefix = getDBPrefix();

$sql = "SELECT
{$prefix}cart.id,
`{$prefix}user`.username,
`{$prefix}user`.id as 'userid',
{$prefix}cart.created_at,
{$prefix}product.price,
{$prefix}cart.product_count,
sum({$prefix}product.price*{$prefix}cart.product_count) as 'total_price',
sum({$prefix}cart.product_count) as 'total_count'
FROM
{$prefix}product
INNER JOIN {$prefix}cart ON {$prefix}cart.product_id = {$prefix}product.id
INNER JOIN `{$prefix}user` ON {$prefix}cart.user_id = `{$prefix}user`.id
GROUP BY username";

$cart_result = queryAll($sql);












?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-title ">所有购物车</h4>
                        <p class="card-category"> 所有购物车列表</p>
                        <p><?php if(hasInfo()) echo getInfo(basename($_SERVER['SCRIPT_NAME'])); ?></p>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class=" text-primary">
                            <th>
                                ID
                            </th>
                            <th>
                                购物车用户
                            </th>
                            <th>
                                商品总量
                            </th>
                            <th>
                                购物车总价
                            </th>
                            <th>
                                添加时间
                            </th>
                            <th>
                                编辑
                            </th>
                        </thead>
                        <tbody>
                            <?php foreach($cart_result as $cart): ?>
                            <tr>
                                <td> <?php echo $cart['userid']; ?> </td>
                                <td> <?php echo $cart['username']; ?> </td>
                                <td> <?php echo $cart['total_count']; ?> </td>
                                <td> <?php echo $cart['total_price']; ?> </td>
                                <td> <?php echo $cart['created_at']; ?> </td>
                                <td> <a href="cart_del.php?id=<?php echo $cart['userid'];?> ">删除</a> </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once "footer.php"; ?>

