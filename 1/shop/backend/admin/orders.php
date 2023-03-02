<?php include_once 'header.php'; ?>
<?php 

require_once '../db.func.php';
require_once '../tools.func.php';
$prefix = getDBPrefix();


$sql = "select * from `{$prefix}order` order by created_at desc";

$order_result = queryAll($sql);
foreach ($order_result as $key => $order) {
  $order_result[$key]['username'] = queryOne("select username from {$prefix}user where id = ".$order['uid'])['username'];
}



?>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <div class="row">
                    <div class="col-12">
                      <h4 class="card-title ">所有订单</h4>
                      <p class="card-category"> 所有订单列表</p>
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
                        下单用户
                      </th>
                      <th>
                        订单价格
                      </th>
                      <th>
                        下单时间
                      </th>
                      </thead>
                      <tbody>
                      <?php foreach($order_result as $order):?>
                      <tr>
                        <td> <?php echo $order['id'] ?> </td>
                        <td> <?php echo $order['username'] ?> </td>
                        <td> <?php echo $order['price'] ?> </td>
                        <td> <?php echo $order['created_at'] ?> </td>
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
<?php include_once 'footer.php'; ?>